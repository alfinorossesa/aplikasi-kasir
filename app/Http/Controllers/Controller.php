<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\DataMenu;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getMenuDetails(array $menuDetails = []) {
        $orderMenus = [];
        foreach ($menuDetails['qty'] as $id => $qty) {
            if (!empty($qty)) {
                $menu = DataMenu::findOrFail($id)->load('dataKategoriMenu');
                $subTotal = $menu->harga * $qty;

                $orderMenus[] = [
                    'id_dataMenu' => $id,
                    'id_dataKategoriMenu' => $menu->dataKategoriMenu->id,
                    'jumlah' => $qty,
                    'sub_total' => $subTotal
                ];
            }
        }
        return $orderMenus;
    }

    public function calculateTotalAmount(array $jumlah = []) {
        $totalAmount = 0;
        foreach ($jumlah['qty'] as $id => $qty) {
            if (!empty($qty)) {
                $menu = DataMenu::find($id);
                $totalAmount += $menu->harga * $qty;
            }
        }

        return $totalAmount;
    }
}
