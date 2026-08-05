<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuccessStory extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by',
        'name',
        'photo_url',
        'grade',
        'is_top_scored',
        'score',
        'course_id',
        'total_score',
        'display_order',
        'description'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
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
        public static function createStory(array $data): self
    {
        return static::create($data);
    }
    public function updateStory(array $data): bool
    {
        return $this->update($data);
    }
    public function updateStoryById(int $id, array $data): bool
    {
        $story = static::find($id);
        return $story? $story->update($data) : false;
    }
    public function deleteStoryById(int $id): bool
    {
        return static::delete();
    }
    public function getAllStories()
    {
        return static::all();
    }
    public function getAllStoriesActive()
    {
        return static::topScored()->get();
    }
    public function getStoryByID(int $id)
    {
        return static::find($id);
    }

}
