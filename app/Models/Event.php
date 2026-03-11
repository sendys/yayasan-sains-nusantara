<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'upcoming_events';

    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'description',
        'content',
        'event_date',
        'location',
        'image',
        'category',
        'registration_link',
        'max_participants',
        'current_participants',
        'status',
        'published_at',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'published_at' => 'datetime',
        'max_participants' => 'integer',
        'current_participants' => 'integer',
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

        return asset('assets/fe/images/courses/course-1.jpg');
    }

    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->event_date)->format('d-m-Y');
    }

    public function getFormattedTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->event_date)->format('H:i');
    }

    public function getAvailableSlotsAttribute()
    {
        if (!$this->max_participants) {
            return null;
        }
        return $this->max_participants - $this->current_participants;
    }

    public function getIsFullAttribute()
    {
        if (!$this->max_participants) {
            return false;
        }
        return $this->current_participants >= $this->max_participants;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeUpcoming($query)
    {
        return $query->published()
                     ->where('event_date', '>', now())
                     ->orderBy('event_date', 'asc');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('event_date', 'desc');
    }
}
