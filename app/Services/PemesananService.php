<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\TransaksiPemesanan;
use Illuminate\Support\Facades\DB;

class PemesananService extends Controller
{
    public function filterPemesanan()
    {
        $filterPemesanan = Pemesanan::has('detailPemesanan')
                    ->has('transaksiPemesanan')
                    ->whereBetween('tanggal', [request('dari_tanggal'), request('sampai_tanggal')])
                    ->latest()->paginate(10);

        return $filterPemesanan;
    }

    public function pemesanan()
    {
        $cari = request('cari');
        $pemesanan = Pemesanan::has('detailPemesanan')->has('transaksiPemesanan')
                                ->whereHas('user', function ($query) use ($cari){
                                    $query->has('pemesanan')->where('nama', 'like', '%' . $cari . '%');
                                })->latest()->paginate(10);

        return $pemesanan;
    }

    public function pemesananStore($request)
    {
        $pemesananStore = DB::transaction(function () use ($request){
            $orderMenus = $this->getMenuDetails($request->jumlah);
            $hargaTotal = $this->calculateTotalAmount($request->jumlah);

            if (count($orderMenus) > 0) {
                $order = Pemesanan::create([
                    'harga_total' => $hargaTotal,
                    'tanggal' => $request->tanggal,
                    'id_user' => auth()->user()->id
                ]);

                if ($order) {
                    $order->detailPemesanan()->createMany($orderMenus);
                }
            } 

        });

        return $pemesananStore;
    }

    public function transaksiPemesananStore($request)
    {
        $transaksi = TransaksiPemesanan::create([
                        'total' => $request->total,
                        'dibayar' => $request->dibayar,
                        'sisa' => $request->sisa,
                        'id_pemesanan' => $request->id_pemesanan
                    ]);

        return $transaksi;
    }
}