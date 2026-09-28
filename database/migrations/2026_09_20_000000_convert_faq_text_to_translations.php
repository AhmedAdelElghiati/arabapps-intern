<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->json('question_translations')->nullable();
            $table->json('answer_translations')->nullable();
            $table->json('category_translations')->nullable();
        });

        DB::table('faqs')->select('id', 'question', 'answer', 'category')->orderBy('id')->each(function ($faq) {
            DB::table('faqs')->where('id', $faq->id)->update([
                'question_translations' => json_encode($this->translations($faq->question), JSON_UNESCAPED_UNICODE),
                'answer_translations' => json_encode($this->translations($faq->answer), JSON_UNESCAPED_UNICODE),
                'category_translations' => $faq->category === null
                    ? null
                    : json_encode($this->translations($faq->category), JSON_UNESCAPED_UNICODE),
            ]);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question', 'answer', 'category']);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->renameColumn('question_translations', 'question');
            $table->renameColumn('answer_translations', 'answer');
            $table->renameColumn('category_translations', 'category');
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->text('question_text')->nullable();
            $table->text('answer_text')->nullable();
            $table->text('category_text')->nullable();
        });

        DB::table('faqs')->select('id', 'question', 'answer', 'category')->orderBy('id')->each(function ($faq) {
            DB::table('faqs')->where('id', $faq->id)->update([
                'question_text' => $this->defaultTranslation($faq->question),
                'answer_text' => $this->defaultTranslation($faq->answer),
                'category_text' => $faq->category === null ? null : $this->defaultTranslation($faq->category),
            ]);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question', 'answer', 'category']);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->renameColumn('question_text', 'question');
            $table->renameColumn('answer_text', 'answer');
            $table->renameColumn('category_text', 'category');
        });
    }

    private function translations(?string $value): array
    {
        if ($value !== null) {
            $decoded = json_decode($value, true);
            if (is_array($decoded) && ! array_is_list($decoded)) {
                return $decoded;
            }
        }

        return ['en' => $value];
    }

    private function defaultTranslation(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? ($decoded['en'] ?? null) : $value;
    }
};