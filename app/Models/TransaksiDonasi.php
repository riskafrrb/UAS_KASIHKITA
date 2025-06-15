<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Donasi;

class TransaksiDonasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'donasi_id',
        'jumlah',
    ];

    // ✅ Tambahkan relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // (Opsional) Tambahkan relasi ke Donasi
    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }
}
