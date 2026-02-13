<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'product';

    protected $fillable = [
        'uuid',
        'product_code',
        'barcode',
        'product_name',
        'satuan_id',
        'kategori_id',
        'purchase_price',
        'selling_price',
        'stock',
        'stock_min',
        'stock_max',
        'image',
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    // Add this relationship
    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    // Add helper methods for easier access
    public function category()
    {
        return $this->kategori();
    }

    public function unit()
    {
        return $this->satuan();
    }

    // Accessor for name (to match the existing Livewire component)
    public function getNameAttribute()
    {
        return $this->product_name;
    }

    // Accessor for code (to match the existing Livewire component)
    public function getCodeAttribute()
    {
        return $this->product_code;
    }
}
