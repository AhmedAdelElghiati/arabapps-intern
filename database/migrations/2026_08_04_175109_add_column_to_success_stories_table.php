<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('success_stories', function (Blueprint $table) {
            // track - display_order - description(comment or quote) - is_active
            $table->string('track')->nullable();
            $table->integer('display_order')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->nullable()->default(true);

        });
    }

    public function down(): void
    {
        Schema::table('success_stories', function (Blueprint $table) {
            $table->dropColumn([ 'track', 'display_order', 'description', 'is_active' ]);
        });
    }
};
