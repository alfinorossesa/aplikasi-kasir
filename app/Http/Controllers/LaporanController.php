<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\detailPemesanan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari_tanggal = $request->dari_tanggal;
        $sampai_tanggal = $request->sampai_tanggal;

        if ($request->submit == 'submit') 
        {
            $filterPemesanan = Pemesanan::has('detailPemesanan')->has('transaksiPemesanan')->whereBetween('tanggal', [$dari_tanggal, $sampai_tanggal])->latest()->get();
            return view('laporan.index', compact('filterPemesanan', 'request', 'dari_tanggal', 'sampai_tanggal'));

        } else{
            
            $pemesanan = Pemesanan::has('detailPemesanan')->has('transaksiPemesanan')->latest()->get();

            return view('laporan.index', compact('pemesanan', 'request', 'dari_tanggal', 'sampai_tanggal'));
        } 

    }
}
