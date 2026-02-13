<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brand';

    protected $fillable = [
        'id',
        'nama',
        'deskripsi',
        'logo',
        'is_active',
        'uuid',
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
            // Hapus file logo saat model dihapus
            if ($model->logo && Storage::disk('public')->exists($model->logo)) {
                Storage::disk('public')->delete($model->logo);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return Storage::disk('public')->url($this->logo);
        }

        return asset('assets/images/default-brand.png');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    public function productCount()
    {
        return $this->products()->count();
    }
}
