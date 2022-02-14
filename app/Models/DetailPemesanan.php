<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pemesanan;
use App\Models\DataKategoriMenu;
use App\Models\DataMenu;

class DetailPemesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'detail_pemesanan';

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    public function dataKategoriMenu()
    {
        return $this->belongsTo(DataKategoriMenu::class, 'id_dataKategoriMenu');
    }

    public function dataMenu()
    {
        return $this->belongsTo(DataMenu::class, 'id_dataMenu');
    }

}
