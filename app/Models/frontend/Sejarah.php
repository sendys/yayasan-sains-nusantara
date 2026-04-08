<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Sejarah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sejarah';

    protected $fillable = [
        'uuid',
        'deskripsi',
        'deskripsi_en',
        'deskripsi_id',
    ];

    const CACHE_KEY = 'sejarah_section';

    /**
     * Get the description based on current locale
     */
    public function getDeskripsiAttribute($value)
    {
        $locale = app()->getLocale();
        
        if ($locale === 'en' && !empty($this->deskripsi_en)) {
            return $this->deskripsi_en;
        } elseif ($locale === 'id' && !empty($this->deskripsi_id)) {
            return $this->deskripsi_id;
        }
        
        return $value; // fallback to default deskripsi
    }

    /**
     * Boot the model and auto-generate UUID
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });

        static::saved(function () {
            Cache::forget(self::CACHE_KEY);
        });

        static::deleted(function () {
            Cache::forget(self::CACHE_KEY);
        });
    }
}
