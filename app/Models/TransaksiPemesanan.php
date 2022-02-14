<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pemesanan;

class TransaksiPemesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'transaksi_pemesanan';

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
