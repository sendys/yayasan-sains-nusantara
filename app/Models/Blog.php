<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog';

    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'author',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });

        static::saving(function ($model) {
            if ($model->status === 'published' && !$model->published_at) {
                $model->published_at = now();
            }
        });

        static::deleting(function ($model) {
            if ($model->image && Storage::disk('public')->exists($model->image)) {
                Storage::disk('public')->delete($model->image);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return asset('assets/fe/images/blog/post-1.jpg');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }
}
