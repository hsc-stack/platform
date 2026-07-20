<?php

namespace App\Console\Commands;

use App\Services\GoogleDriveBackupService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class BackupToDrive extends Command
{
    protected $signature = 'backup:drive';

    protected $description = 'Backup the database and storage, archive them, and upload the archive to Google Drive';

    protected string $backupDir;

    protected string $databaseDumpPath;

    protected string $storageTarPath;

    protected string $finalArchivePath;

    public function __construct(protected GoogleDriveBackupService $driveService)
    {
        parent::__construct();

        $timestamp = now()->format('Y-m-d_His');

        $this->backupDir = storage_path('app/backups');
        $this->databaseDumpPath = $this->backupDir . '/database.sql.gz';
        $this->storageTarPath = $this->backupDir . '/storage.tar';
        $this->finalArchivePath = $this->backupDir . "/hsc-stack-backup-{$timestamp}.tar.gz";
    }

    public function handle(): int
    {
        File::ensureDirectoryExists($this->backupDir);

        try {
            $this->info('Step 1/4: Dumping database…');
            $this->backupDatabase();

            $this->info('Step 2/4: Archiving storage/app/public…');
            $this->backupStorage();

            $this->info('Step 3/4: Building final archive…');
            $this->createFinalArchive();

            $this->info('Step 4/4: Uploading to Google Drive…');
            $fileId = $this->driveService->upload($this->finalArchivePath);

            $this->cleanupLocalArchive();

            $this->info("Backup complete. Google Drive file ID: {$fileId}");
            Log::info('backup:drive completed successfully.', ['drive_file_id' => $fileId]);

            return self::SUCCESS;
        } catch (Exception $e) {
            $this->error('Backup failed: ' . $e->getMessage());
            Log::error('backup:drive failed.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Leave temp files in place on failure so the run can be inspected/retried.
            return self::FAILURE;
        }
    }

    /**
     * Dump the database with mysqldump, then gzip it.
     * Credentials come from Laravel's own database config — never hardcoded,
     * and the password is passed via the MYSQL_PWD env var, not argv,
     * so it never shows up in `ps` output or shell history.
     */
    protected function backupDatabase(): void
    {
        $connectionName = config('database.default');
        $connection = config("database.connections.{$connectionName}");

        if (! $connection || ($connection['driver'] ?? null) !== 'mysql') {
            throw new Exception('backup:drive currently supports MySQL connections only.');
        }

        $plainSqlPath = $this->backupDir . '/database.sql';

        $command = [
            'mysqldump',
            '--host=' . $connection['host'],
            '--port=' . $connection['port'],
            '--user=' . $connection['username'],
            '--single-transaction',
            '--quick',
            '--result-file=' . $plainSqlPath,
            $connection['database'],
        ];

        $result = Process::env(['MYSQL_PWD' => $connection['password']])
            ->timeout(600)
            ->run($command);

        if ($result->failed()) {
            throw new Exception('mysqldump failed: ' . $result->errorOutput());
        }

        // Compress with PHP's zlib rather than shelling out to gzip —
        // one less external dependency and no shell interpolation involved.
        $this->gzipFile($plainSqlPath, $this->databaseDumpPath);
        File::delete($plainSqlPath);
    }

    /**
     * Tar up storage/app/public. No compression here — the outer archive
     * (hsc-stack-backup.tar.gz) compresses everything together at the end.
     */
    protected function backupStorage(): void
    {
        $publicStoragePath = storage_path('app/public');

        if (! File::isDirectory($publicStoragePath)) {
            throw new Exception("Storage path not found: {$publicStoragePath}");
        }

        $result = Process::timeout(600)
            ->run(['tar', '-cf', $this->storageTarPath, '-C', storage_path('app'), 'public']);

        if ($result->failed()) {
            throw new Exception('Storage archive failed: ' . $result->errorOutput());
        }
    }

    /**
     * Bundle database.sql.gz + storage.tar into the final archive,
     * then remove the two temporary files — only the final archive remains.
     */
    protected function createFinalArchive(): void
    {
        $result = Process::path($this->backupDir)
            ->timeout(600)
            ->run([
                'tar',
                '-czf',
                $this->finalArchivePath,
                basename($this->databaseDumpPath),
                basename($this->storageTarPath),
            ]);

        if ($result->failed()) {
            throw new Exception('Final archive creation failed: ' . $result->errorOutput());
        }

        File::delete([$this->databaseDumpPath, $this->storageTarPath]);
    }

    protected function cleanupLocalArchive(): void
    {
        File::delete($this->finalArchivePath);
    }

    protected function gzipFile(string $source, string $destination): void
    {
        $sourceHandle = fopen($source, 'rb');
        $destHandle = gzopen($destination, 'wb9');

        if ($sourceHandle === false || $destHandle === false) {
            throw new Exception('Unable to open files for gzip compression.');
        }

        while (! feof($sourceHandle)) {
            gzwrite($destHandle, fread($sourceHandle, 1024 * 512));
        }

        fclose($sourceHandle);
        gzclose($destHandle);
    }
}
