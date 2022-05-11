<?php

namespace App\Services;

use App\Models\Pemesanan;

class LaporanService
{
    public function filterPemesanan()
    {
        $filterPemesanan = Pemesanan::has('detailPemesanan')
                                    ->has('transaksiPemesanan')
                                    ->whereBetween('tanggal', [request('dari_tanggal'), request('sampai_tanggal')])
                                    ->latest()->get();

        return $filterPemesanan;
    }
}