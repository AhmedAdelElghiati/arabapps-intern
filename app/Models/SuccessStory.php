<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Spatie\Translatable\Attributes\Translatable;

#[Translatable('name', 'description')]
class SuccessStory extends Model
{
    use HasTranslations , HasFactory;
    protected $fillable = [
        'created_by',
        'name',
        'photo_url',
        'grade',
        'is_top_scored',
        'display_order',
        'description',
        'is_active',
        'track',
    ];
    // public array $translatable = ['name', 'description'];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
    public function scopeTopScored(Builder $query): Builder
    {
        return $query->where('is_top_scored', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order', 'asc')->latest();
    }

}
