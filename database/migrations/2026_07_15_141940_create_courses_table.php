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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_url');
            $table->text('description');
            $table->boolean('is_free')->default(False);
            $table->decimal('price')->default(0);
            $table->decimal('discount')->default(0);
            $table->string('level');
            $table->integer('duration');
            $table->integer('display_order');
            $table->boolean('is_desmos_enabled')->default(false);
            $table->boolean('show_at_home')->default(false);
            $table->boolean('is_published')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->dateTime('publish_date')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
