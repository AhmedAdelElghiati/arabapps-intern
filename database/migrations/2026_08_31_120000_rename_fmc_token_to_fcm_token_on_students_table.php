<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sync databases created before the fmc_token -> fcm_token typo fix.
     * No-op on fresh installs where the column is already named fcm_token.
     */
    public function up(): void
    {
        if (Schema::hasColumn('students', 'fmc_token') && ! Schema::hasColumn('students', 'fcm_token')) {
            Schema::table('students', function (Blueprint $table) {
                $table->renameColumn('fmc_token', 'fcm_token');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('students', 'fcm_token') && ! Schema::hasColumn('students', 'fmc_token')) {
            Schema::table('students', function (Blueprint $table) {
                $table->renameColumn('fcm_token', 'fmc_token');
            });
        }
    }
};
