<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPemesanan;
use App\Models\TransaksiPemesanan;
use App\Models\User;

class Pemesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pemesanan';

    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_pemesanan');
    }

    public function transaksiPemesanan()
    {
        return $this->hasMany(TransaksiPemesanan::class, 'id_pemesanan');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
