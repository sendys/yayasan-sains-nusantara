<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeline extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'timeline';

    protected $fillable = [
        'tentang_kami_id',
        'year',
        'title',
        'description',
        'position',
        'order'
    ];

    public function Tentang()
    {
        return $this->belongsTo(TentangKami::class, 'tentang_kami_id');
    }
}
