<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    protected $table = 'pesertas';

    protected $fillable = [
        'nomor_peserta', 'nik', 'nama', 'jenis_kelamin', 'email', 'no_telepon',
        'tanggal_lahir', 'alamat', 'skema_id',
    ];

    protected $casts = ['tanggal_lahir' => 'date'];

    public function skema(): BelongsTo
    {
        return $this->belongsTo(Skema::class, 'skema_id');
    }

    /** Pencarian berdasarkan nomor peserta, NIK, nama, atau email. */
    public function scopeCari(Builder $query, ?string $kata): Builder
    {
        return $query->when($kata, function (Builder $q) use ($kata) {
            $q->where(function (Builder $w) use ($kata) {
                $w->where('nomor_peserta', 'like', "%{$kata}%")
                  ->orWhere('nik', 'like', "%{$kata}%")
                  ->orWhere('nama', 'like', "%{$kata}%")
                  ->orWhere('email', 'like', "%{$kata}%");
            });
        });
    }
}
