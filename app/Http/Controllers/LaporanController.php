<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Services\LaporanService;

class LaporanController extends Controller
{
    protected $laporan;
    public function __construct(LaporanService $laporan)
    {
        $this->laporan = $laporan;
    }

    public function index()
    {
        if (request()->has('submit')) {
            $filterPemesanan = $this->laporan->filterPemesanan();
            
            return view('laporan.index', compact('filterPemesanan'));
        } 
            
        $pemesanan = Pemesanan::has('detailPemesanan')->has('transaksiPemesanan')->latest()->get();

        return view('laporan.index', compact('pemesanan')); 
    }
}
