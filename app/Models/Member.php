<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected $fillable = [
        'nama_member',
        'email',
        'jenis_kelamin',
        'tanggal_lahir',
        'nama_rekening',
        'foto_member',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date:Y-m-d',
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiBuku::class);
    }
}
