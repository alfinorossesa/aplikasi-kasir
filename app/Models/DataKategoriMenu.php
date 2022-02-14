<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataMenu;
use App\Models\DetailPenjualan;
use App\Models\OrderMenuDetail;

class DataKategoriMenu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'data_kategori_menu';

    public function dataMenu()
    {
        return $this->hasMany(DataMenu::class, 'id_dataKategoriMenu');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function orderMenuDetail()
    {
        return $this->hasMany(OrderMenuDetail::class, 'category_id');
    }
}
