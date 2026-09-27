<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('exam_submissions')->cascadeOnDelete();

            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();

            $table->foreignId('choice_id')->nullable()->constrained('exam_options')->cascadeOnDelete();
            $table->boolean('is_flagged')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
