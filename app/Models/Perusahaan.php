<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perusahaan extends Model
{
    use SoftDeletes;

    protected $table = 'perusahaan';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'start_date',
        'end_date',
        'is_premium',
        'is_status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope untuk perusahaan dengan lisensi expired
     */
    public function scopeExpired($query)
    {
        return $query->where('end_date', '<', now())
            ->where('is_status', true);
    }

    /**
     * Scope untuk perusahaan dengan lisensi akan expired dalam X hari
     */
    public function scopeExpiringSoon($query, $days = 7)
    {
        return $query->where('end_date', '>', now())
            ->where('end_date', '<=', now()->addDays($days))
            ->where('is_status', true);
    }

    /**
     * Check apakah lisensi sudah expired
     */
    public function isExpired()
    {
        return $this->end_date && $this->end_date < now();
    }

    /**
     * Check apakah lisensi akan expired dalam X hari
     */
    public function isExpiringSoon($days = 7)
    {
        if (! $this->end_date) {
            return false;
        }

        $now = now();
        $expiryDate = $this->end_date;

        // Cek apakah tanggal expired masih di masa depan dan dalam rentang X hari
        return $expiryDate > $now && $expiryDate <= $now->addDays($days);
    }

    /**
     * Get jumlah hari tersisa sebelum expired
     */
    public function getDaysUntilExpiry()
    {
        if (! $this->end_date || $this->isExpired()) {
            return 0;
        }

        return ceil(now()->diffInDays($this->end_date));
    }

    /**
     * Get jumlah hari terlambat
     */
    public function getDaysOverdue()
    {
        if (! $this->isExpired()) {
            return 0;
        }

        return floor($this->end_date->floatDiffInDays(now()));
    }
}
