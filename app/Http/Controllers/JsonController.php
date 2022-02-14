<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMenu;

class JsonController extends Controller
{
    public function getMenuByCategory($categoryId)
    {
        $menu = DataMenu::where('id_dataKategoriMenu', $categoryId)->with('dataKategoriMenu')->paginate(5);
        return response()->json($menu, 200);
    }

    public function getTotalAmount(Request $request)
    {
        $hargaTotal = $this->calculateTotalAmount($request->jumlah);
        $data = ['total_amount' => number_format($hargaTotal)];

        return response()->json($data, 200);
    }
}
