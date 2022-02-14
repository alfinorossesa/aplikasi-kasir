<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataKetegoriMenu;
use App\Models\DetailPenjualan;
use App\Models\OrderMenuDetail;

class DataMenu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'data_menu';

    public function dataKategoriMenu()
    {
        return $this->belongsTo(DataKategoriMenu::class, 'id_dataKategoriMenu');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function orderMenuDetail()
    {
        return $this->hasMany(OrderMenuDetail::class, 'menu_id');
    }
}
