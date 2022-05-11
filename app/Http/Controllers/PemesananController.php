<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKategoriMenu;
use App\Models\DataMenu;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use PDF;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\TransaksiPemesananRequest;
use App\Services\PemesananService;

class PemesananController extends Controller
{
    protected $pemesanan;
    public function __construct(PemesananService $pemesanan)
    {
        $this->pemesanan = $pemesanan;
    }

    public function index(Request $request)
    {
        if (request()->has('submit')) {
            $filterPemesanan = $this->pemesanan->filterPemesanan();
            $detailPemesanan = DetailPemesanan::all();
            
            return view('pemesanan.index', compact('filterPemesanan', 'detailPemesanan'));
        } 

        $pemesanan = $this->pemesanan->pemesanan();
        $detailPemesanan = DetailPemesanan::all();
        $pemesanan->appends($request->all());

        return view('pemesanan.index', compact('pemesanan', 'detailPemesanan'));
        
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
        $this->pemesanan->pemesananStore($request);

        return redirect()->route('pemesanan.transaksiPemesanan');
    }

    public function transaksiPemesanan()
    {
        $pemesanan = Pemesanan::latest()->first();
        $detailPemesanan = DetailPemesanan::all();

        return view('pemesanan.transaksi-pemesanan', compact('pemesanan', 'detailPemesanan'));
    }

    public function transaksiPemesananStore(TransaksiPemesananRequest $request)
    {
        $this->pemesanan->transaksiPemesananStore($request);

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
