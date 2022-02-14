<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKategoriMenu;
use App\Models\DataMenu;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\TransaksiPemesanan;
use App\Models\User;
use Auth;
use PDF;
use App\Http\Requests\StorePostRequest;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $dari_tanggal = $request->dari_tanggal;
        $sampai_tanggal = $request->sampai_tanggal;

        $cari = $request->cari;

        if ($request->submit == 'submit') 
        {
            $filterPemesanan = Pemesanan::has('detailPemesanan')->has('transaksiPemesanan')->whereBetween('tanggal', [$dari_tanggal, $sampai_tanggal])->latest()->paginate(10);
            $detailPemesanan = DetailPemesanan::all();

            return view('pemesanan.index', compact('filterPemesanan', 'detailPemesanan', 'request', 'dari_tanggal', 'sampai_tanggal', 'cari'));

        } else {

            $pemesanan = Pemesanan::has('detailPemesanan')->has('transaksiPemesanan')
            ->whereHas('user', function ($query) use ($cari){
                $query->has('pemesanan')->where('nama', 'like', '%' . $cari . '%');
            })->latest()->paginate(10);

            $detailPemesanan = DetailPemesanan::all();

            $pemesanan->appends($request->all());
            return view('pemesanan.index', compact('pemesanan', 'detailPemesanan', 'request', 'dari_tanggal', 'sampai_tanggal', 'cari'));
        }

    }

    public function create()
    {
        $pemesanan = Pemesanan::latest()->first();
        $dataKategoriMenu = DataKategoriMenu::has('dataMenu')->get();

        return view('pemesanan.create', compact('pemesanan', 'dataKategoriMenu',));
    }

    public function jsonDataMenu($id)
    {
        $dataMenu = DataMenu::find($id);
        return response()->json($dataMenu, 200);
    }

    public function store(StorePostRequest $request)
    {
        \DB::transaction(function () use ($request){
            $orderMenus = $this->getMenuDetails($request->jumlah);
            $hargaTotal = $this->calculateTotalAmount($request->jumlah);
            
            $idUser = Auth::user()->id;

            $this->validate($request, [
                'tanggal' => 'required'
            ]);

            if (count($orderMenus) > 0) {
                $order = Pemesanan::create([
                    'harga_total' => $hargaTotal,
                    'tanggal' => $request->tanggal,
                    'id_user' => $idUser
                ]);

                if ($order) {
                    $order->detailPemesanan()->createMany($orderMenus);
                }
            } 

        });

        return redirect()->route('pemesanan.transaksiPemesanan');
    }

    public function transaksiPemesanan()
    {
        $pemesanan = Pemesanan::latest()->first();
        $detailPemesanan = DetailPemesanan::all();

        return view('pemesanan.transaksi-pemesanan', compact('pemesanan', 'detailPemesanan'));
    }

    public function transaksiPemesananStore(Request $request)
    {
        $this->validate($request, [
            'total' => 'required',
            'dibayar' => 'required',
            'sisa' => 'required'
        ]);

        TransaksiPemesanan::create([
            'total' => $request->total,
            'dibayar' => $request->dibayar,
            'sisa' => $request->sisa,
            'id_pemesanan' => $request->id_pemesanan
        ]);

        return redirect()->route('pemesanan.index');
    }

    public function detail($id)
    {
        $pemesanan = Pemesanan::find($id);
        $detailPemesanan = DetailPemesanan::all();

        return view('pemesanan.detail', compact('pemesanan', 'detailPemesanan'));
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::find($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index');
    }

    public function cetakPDF($id)
    {
        $pemesanan = Pemesanan::find($id);
        $detailPemesanan = DetailPemesanan::all();

        $pdf = PDF::loadView('pemesanan.cetaknota', compact('pemesanan', 'detailPemesanan'));
        return $pdf->download('Nota Pemesanan.pdf');
    }
}
