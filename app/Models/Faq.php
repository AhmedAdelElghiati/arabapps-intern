<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Faq extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'question',
        'answer',
        'publish_date',
        'category',
        'display_order',
        'created_by',
    ];

    public array $translatable = [
        'question',
        'answer',
        'category',
    ];
}