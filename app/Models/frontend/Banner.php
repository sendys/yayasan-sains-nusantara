<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'banner';

    protected $fillable = ['image', 'is_active'];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
