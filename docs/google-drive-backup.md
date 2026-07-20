# Google Drive Backup Setup

This project supports automatic database and storage backups to Google Drive using the Google Drive API.

## Prerequisites

Install the Google API PHP Client:

```bash
composer require google/apiclient:^2.15
```

---

## 1. Create a Google Cloud Project

1. Go to Google Cloud Console.
2. Create a new project (for example: `hsc-stack-backups`).
3. Open **APIs & Services → Library**.
4. Search for **Google Drive API**.
5. Click **Enable**.

---

## 2. Configure the OAuth Consent Screen

1. Navigate to **APIs & Services → OAuth consent screen**.
2. Choose **External** as the user type.
3. Fill in the required information:

    - App name
    - User support email
    - Developer contact email

4. Save and continue through the remaining steps.

### Add the Drive Scope

Add the following scope:

```
https://www.googleapis.com/auth/drive.file
```

This scope allows the application to access only the files it creates, instead of your entire Google Drive.

### Add Test Users

While the application is in **Testing** mode, add the Google account that will store your backups under **Test users**.

Publishing the application is **not required** for personal use.

---

## 3. Create OAuth Credentials

1. Go to **APIs & Services → Credentials**.
2. Click **Create Credentials → OAuth client ID**.
3. Choose:

```
Application type: Desktop app
```

4. Give it a name (for example: `hsc-stack-backup-cli`).
5. Create the credentials.

Copy the following values:

- Client ID
- Client Secret

---

## 4. Configure Environment Variables

Add the credentials to your `.env` file.

```env
GOOGLE_DRIVE_CLIENT_ID=
GOOGLE_DRIVE_CLIENT_SECRET=
GOOGLE_DRIVE_REFRESH_TOKEN=
GOOGLE_DRIVE_FOLDER_NAME=backup
```

These values are loaded by the application's configuration:

```php
'google_drive' => [
    'client_id' => env('GOOGLE_DRIVE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
    'refresh_token' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
    'folder_name' => env('GOOGLE_DRIVE_FOLDER_NAME', 'backup'),
],
```

---

## 5. One-Time Authorization

Run:

```bash
php artisan backup:drive-authorize
```

The command will:

1. Generate a Google authorization URL.
2. Ask you to open it in your browser.
3. Sign in using the Google account added as a test user.
4. Grant permission to the application.
5. Copy the authorization code shown by Google.
6. Paste the code back into the terminal.

The command will then output a refresh token similar to:

```text
GOOGLE_DRIVE_REFRESH_TOKEN=1//0gxxxxxxxxxxxxxxxxxxxxxxxx
```

Copy this value into your `.env` file.

> **Note**
>
> This authorization only needs to be completed once. The refresh token is reused to obtain new access tokens automatically, allowing scheduled backups (cron jobs) to run without any further user interaction.

---

## 6. Run a Backup

Create and upload a backup to Google Drive:

```bash
php artisan backup:drive
```

If the configured Drive folder does not already exist, it will be created automatically.

---

## Automation

After the refresh token has been configured, backups can be executed from a cron job or Laravel Scheduler without requiring a browser or manual authentication.
