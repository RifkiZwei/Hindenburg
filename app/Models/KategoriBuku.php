<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBuku extends Model
{
    use HasFactory;

    public const GENRES = [
        'Fiksi',
        'Romance',
        'Horror',
        'Komedi',
        'Misteri',
        'Petualangan',
        'Fantasi',
        'Sejarah',
        'Biografi',
        'Pendidikan',
        'Agama',
        'Sains',
    ];

    protected $table = 'kategori_buku';

    protected $fillable = [
        'nama_kategori',
        'foto_kategori',
    ];

    public function buku(): HasMany
    {
        return $this->hasMany(Buku::class, 'kategori_id');
    }
}
