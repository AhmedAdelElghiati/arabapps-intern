<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
     use HasFactory;
    protected $fillable = [
        'question',
        'answer',
        'publish_date',
        'category',
        'display_order',
        'created_by',

    ];
    protected $casts = [
       'category'=> \App\Enum\FaqsEnum::class,
    ];
   
}
