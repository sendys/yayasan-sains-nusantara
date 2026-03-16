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

    protected $appends = [
        'image_url',
        'formatted_date',
        'formatted_time',
        'formatted_event_date',
        'available_slots',
        'is_full',
        'is_upcoming',
        'is_published',
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
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }
        return asset('assets/fe/images/events/default-event.jpg');
    }

    public function getFormattedDateAttribute()
    {
        return $this->event_date ? $this->event_date->format('d-m-Y') : null;
    }

    public function getFormattedTimeAttribute()
    {
        return $this->event_date ? $this->event_date->format('H:i') : null;
    }

    public function getFormattedEventDateAttribute()
    {
        return $this->event_date ? $this->event_date->format('d M Y H:i') : null;
    }

    public function getAvailableSlotsAttribute()
    {
        if (!$this->max_participants) {
            return null;
        }
        return max(0, $this->max_participants - $this->current_participants);
    }

    public function getIsFullAttribute()
    {
        if (!$this->max_participants) {
            return false;
        }
        return $this->current_participants >= $this->max_participants;
    }

    public function getIsUpcomingAttribute()
    {
        return $this->event_date && $this->event_date > now();
    }

    public function getIsPublishedAttribute()
    {
        return $this->status === 'published'
            && $this->published_at !== null
            && $this->published_at <= now();
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

    /**
     * Scope: Search events by title, description, location, or category
     */
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }
        return $query->where('title', 'like', "%{$search}%")
                     ->orWhere('description', 'like', "%{$search}%")
                     ->orWhere('location', 'like', "%{$search}%")
                     ->orWhere('category', 'like', "%{$search}%");
    }

    /**
     * Scope: Filter by status
     */
    public function scopeByStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Scope: Filter by category
     */
    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }
}
