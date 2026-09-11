<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'isbn',
        'nama_buku',
        'foto_buku',
        'stok',
        'kategori_id',
    ];

    protected $casts = [
        'stok' => 'integer',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id');
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiBuku::class);
    }
}
