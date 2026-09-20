<?php

namespace App\Models;

use App\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Scalable News model - ready for thousands of records.
 * Uses slug index, status enum, published_at, soft deletes.
 * Projection via scopeSelectCard, eager loading ready.
 */
class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'category_id', 'author_id',
        'author_name', 'image', 'image_thumb', 'status', 'published_at',
        'tags', 'read_time',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'tags' => 'array',
        'status' => ContentStatus::class,
    ];

    // Indexes automatically via migration: slug unique, status, published_at, category_id

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', ContentStatus::Published->value)
            ->where('published_at', '<=', now());
    }

    public function scopeSelectCard(Builder $query): Builder
    {
        return $query->select(['id', 'title', 'slug', 'excerpt', 'category_id', 'author_id', 'image', 'published_at', 'read_time']);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
