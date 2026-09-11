<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiBuku extends Model
{
    use HasFactory;

    protected $table = 'transaksi_buku';

    protected $fillable = ['member_id', 'buku_id', 'jenis', 'jumlah'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }
}
