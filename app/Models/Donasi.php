<?php

namespace App\Models;
use App\Models\TransaksiDonasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasis'; 
    
    // ✅ Tambahkan 'user_id' agar bisa disimpan
    protected $fillable = [
    'user_id',
    'judul',
    'penerima',
    'kontak',
    'kategori',
    'target',
    'rekening',
    'bank',
    'keterangan',
    'status'
];



    // ✅ Relasi: Donasi dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transaksiDonasi()
{
    return $this->hasMany(TransaksiDonasi::class);
}

}
