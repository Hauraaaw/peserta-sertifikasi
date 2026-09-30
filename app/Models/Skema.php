<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skema extends Model
{
    public const JENIS = ['KKNI', 'Okupasi', 'Klaster'];

    protected $table = 'skemas';

    protected $fillable = ['kode_skema', 'nama_skema', 'jenis', 'deskripsi'];

    public function pesertas(): HasMany
    {
        return $this->hasMany(Peserta::class, 'skema_id');
    }

    /** Pencarian berdasarkan kode skema, nama skema, atau jenis. */
    public function scopeCari(Builder $query, ?string $kata): Builder
    {
        return $query->when($kata, function (Builder $q) use ($kata) {
            $q->where(function (Builder $w) use ($kata) {
                $w->where('kode_skema', 'like', "%{$kata}%")
                  ->orWhere('nama_skema', 'like', "%{$kata}%")
                  ->orWhere('jenis', 'like', "%{$kata}%");
            });
        });
    }
}