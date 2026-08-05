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
            // score - course_name - total_score - display_order - description(comment or quote)
            $table->float('score')->nullable();
            $table->string('course_name')->nullable();
            $table->integer('total_score')->nullable();
            $table->integer('display_order')->nullable();
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('success_stories', function (Blueprint $table) {
            $table->dropColumn(['score', 'course_name', 'total_score', 'display_order', 'description']);
        });
    }
};
