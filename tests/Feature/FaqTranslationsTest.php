<?php

use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates an FAQ with Arabic and English translations', function () {
    $faq = Faq::create([
        'question' => ['en' => 'How can I enroll?', 'ar' => 'كيف يمكنني التسجيل؟'],
        'answer' => ['en' => 'From the course page.', 'ar' => 'من صفحة الكورس.'],
        'category' => ['en' => 'Courses', 'ar' => 'الكورسات'],
        'display_order' => 1,
    ]);

    expect($faq->getTranslation('question', 'en'))->toBe('How can I enroll?')
        ->and($faq->getTranslation('question', 'ar'))->toBe('كيف يمكنني التسجيل؟')
        ->and($faq->getTranslation('category', 'en'))->toBe('Courses')
        ->and($faq->getTranslation('category', 'ar'))->toBe('الكورسات');
});

it('updates FAQ translations without changing non-translatable fields', function () {
    $faq = Faq::factory()->create(['display_order' => 7, 'created_by' => null]);

    $faq->update([
        'question' => ['en' => 'Updated question', 'ar' => 'سؤال محدث'],
        'answer' => ['en' => 'Updated answer', 'ar' => 'إجابة محدثة'],
        'category' => ['en' => 'Technical', 'ar' => 'تقني'],
    ]);

    expect($faq->fresh()->display_order)->toBe(7)
        ->and($faq->fresh()->getTranslation('question', 'ar'))->toBe('سؤال محدث')
        ->and($faq->fresh()->getTranslation('answer', 'en'))->toBe('Updated answer')
        ->and($faq->fresh()->getTranslation('category', 'ar'))->toBe('تقني');
});

it('returns the requested FAQ translation from the API locale', function () {
    $faq = Faq::factory()->create([
        'question' => ['en' => 'English question', 'ar' => 'السؤال بالعربية'],
        'answer' => ['en' => 'English answer', 'ar' => 'الإجابة بالعربية'],
        'category' => ['en' => 'General', 'ar' => 'عام'],
        'created_by' => null,
    ]);

    $this->getJson('/api/faqs/' . $faq->id, ['Accept-Language' => 'ar'])
        ->assertOk()
        ->assertJsonPath('data.question', 'السؤال بالعربية')
        ->assertJsonPath('data.answer', 'الإجابة بالعربية')
        ->assertJsonPath('data.category', 'عام');

    $this->getJson('/api/faqs/' . $faq->id, ['Accept-Language' => 'en'])
        ->assertOk()
        ->assertJsonPath('data.question', 'English question')
        ->assertJsonPath('data.category', 'General');
});