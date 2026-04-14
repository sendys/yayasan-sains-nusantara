<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'galeri';

    protected $fillable = [
        'uuid',
        'title',
        'deskripsi',
        'image',
        'kategori',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
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

        return asset('assets/images/placeholder.jpg');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public static function getKategoriList()
    {
        return [
            'sosialisasi' => 'Sosialisasi',
            'kunjungan' => 'Kunjungan',
            'pelatihan' => 'Pelatihan',
            'seminar' => 'Seminar',
            'workshop' => 'Workshop',
            'lainnya' => 'Lainnya',
        ];
    }
}