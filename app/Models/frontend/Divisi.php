<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Divisi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'divisi';

    protected $fillable = [
        'uuid',
        'deskripsi_id',
        'deskripsi_en',
    ];

    const CACHE_KEY = 'divisi_section';

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });

        static::saved(function () {
            Cache::forget(self::CACHE_KEY);
        });

        static::deleted(function () {
            Cache::forget(self::CACHE_KEY);
        });
    }
}
