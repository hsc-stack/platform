<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('traffic', function (Blueprint $table) {
            $table->dropColumn('path');
            $table->string('ip_address')->unique()->change();
            $table->unsignedBigInteger('visits')->default(0)->after('source');
        });
    }

    public function down(): void
    {
        Schema::table('traffic', function (Blueprint $table) {
            $table->string('path')->after('source');
            $table->dropUnique(['ip_address']);
            $table->string('ip_address')->change();
            $table->dropColumn('visits');
        });
    }
};
