<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class TentangKami extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tentang_kami';

    protected $fillable = [
        'logo',
        'deskripsi',
        'visi',
        'misi'
    ];

    protected $casts = [
        'misi' => 'array'
    ];

    /*  public function timelines()
     {
         return $this->hasMany(Timeline::class)->orderBy('order');
     } */

    const CACHE_KEY = 'tentang_section';

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget(self::CACHE_KEY);
        });

        static::deleted(function () {
            Cache::forget(self::CACHE_KEY);
        });
    }

}
