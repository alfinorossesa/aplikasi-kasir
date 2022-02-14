@extends('layouts.main')
@section('content')

<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Pemesanan</h4>
    </div>
</div>

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <a href="{{ route('pemesanan.create') }}" class="btn app-btn-secondary">Buat Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-sm-7">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                 <div class="page-utilities">
                    <form action="{{ url('pemesanan') }}" method="POST" class="table-search-form row gx-1 align-items-center">
                    @csrf
                        <div class="col-auto">
                            <label for="dari_tanggal" class="filter-tanggal">Dari Tanggal</label>
                            <input type="date" class="form-control search-orders mb-2" id="dari_tanggal" name="dari_tanggal" required value="{{ $dari_tanggal }}">
                            <label for="sampai_tanggal" class="filter-tanggal">Sampai Tanggal</label>
                            <input type="date" class="form-control search-orders mb-4" id="sampai_tanggal" name="sampai_tanggal" required value="{{ $sampai_tanggal }}">
                        </div>
                        <div>
                            <button type="submit" name="submit" value="submit" class="btn app-btn-primary print">Atur Tanggal</button>
                            <a href="{{ route('pemesanan.index') }}" class="btn app-btn-secondary print">Semua Pemesanan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-5 search-pemesanan">
        <form action="{{ route('pemesanan.index') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="cari" class="form-control" placeholder="Cari Nama Kasir . . . . " value="{{ $cari }}">
                <button type="submit" class="btn app-btn-primary">Cari</button> 
            </div>
        </form>
    </div>
</div>
    
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-3">
            <div class="app-card-body">
                <div class="table-responsive" style="margin-bottom: 500px;">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr class="table-custom">
                                <th class="cell text-white">No.</th>
                                <th class="cell text-white">Tanggal</th> 
                                <th class="cell text-white">Nama Kasir</th>
                                <th class="cell text-white">Nama Menu</th>
                                <th class="cell text-white">Harga Total</th>
                                <th class="cell text-white">Aksi</th>
                            </tr>
                        </thead>

                        {{-- nomer --}}
                        <?php
                            $no = 1;
                        ?>

                        <tbody>
                            @if ($request->submit == 'submit')
                                @foreach ($filterPemesanan as $p)
                                    <tr>
                                        <td class="cell">{{ $no++ }}.</td>
                                        <td class="cell">{{ date('d-m-Y', strtotime($p->detailPemesanan[0]->pemesanan->tanggal)) }}</td>
                                        <td class="cell">{{ $p->user->nama }}</td>
                                        <td class="cell">{{ $p->detailPemesanan[0]->dataMenu->nama_menu }}</td>
                                        <td class="cell">Rp. {{ number_format($p->transaksiPemesanan[0]->total) }}</td>
                                        <td class="cell">
                                            <a href="{{ route('pemesanan.detail', $p->id) }}" class="btn btn-edit btn-sm">Detail</a>
                                            <form action="{{ route('pemesanan.destroy', $p->id) }}" method="POST" style="display: inline;"> 
                                                @csrf 
                                                @method('delete')
                                                <button type="submit" class="btn btn-hapus btn-sm" onclick="return confirm('Apakah anda yakin ?')">Hapus</button>
                                            </form>
                                            <a class="btn app-btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $p->id }}">Cetak Nota</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else 
                                @foreach ($pemesanan as $key => $p)
                                    <tr>
                                        <td class="cell">{{ $pemesanan->firstItem() + $key }}.</td>
                                        <td class="cell">{{ date('d-m-Y', strtotime($p->detailPemesanan[0]->pemesanan->tanggal)) }}</td>
                                        <td class="cell">{{ $p->user->nama }}</td>
                                        <td class="cell">{{ $p->detailPemesanan[0]->dataMenu->nama_menu }}</td>
                                        <td class="cell">Rp. {{ number_format($p->transaksiPemesanan[0]->total) }}</td>
                                        <td class="cell">
                                            <a href="{{ route('pemesanan.detail', $p->id) }}" class="btn btn-edit btn-sm">Detail</a>
                                            <form action="{{ route('pemesanan.destroy', $p->id) }}" method="POST" style="display: inline;"> 
                                                @csrf 
                                                @method('delete')
                                                <button type="submit" class="btn btn-hapus btn-sm" onclick="return confirm('Apakah anda yakin ?')">Hapus</button>
                                            </form>
                                            <a class="btn app-btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $p->id }}">Cetak Nota</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>		
        </div>
        @if ($request->submit == 'submit')
            {{ $filterPemesanan->links() }}
        @else 
            {{ $pemesanan->links() }}
        @endif
    </div>
</div>

@if ($request->submit == 'submit')
    @foreach ($filterPemesanan as $nota)
    <!-- Modal -->
        <div class="modal fade modal-nota" id="staticBackdrop-{{ $nota->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nota Transaksi </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <strong>Tanggal</strong>  
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-9" style="padding: 0;">
                                {{ date('d-m-Y', strtotime($nota->detailPemesanan[0]->pemesanan->tanggal)) }}
                            </div>
                            <div class="col-md-2">
                                <strong>Kasir</strong>
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-9" style="padding: 0;">
                                {{ $nota->user->nama }}
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell ">Nama Menu</th>
                                        <th class="cell ">Jumlah</th>
                                        <th class="cell ">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailPemesanan as $p)
                                        @if ($p->pemesanan->id == $nota->id)
                                            <tr>
                                                <td class="cell">{{ $p->dataMenu->nama_menu }}</td>
                                                <td class="cell">{{ number_format($p->jumlah) }}</td>
                                                <td class="cell">Rp. {{ number_format($p->sub_total) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-6"></div>
                            <div class="col-md-2">
                                <strong>Total</strong>  
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-3" style="padding: 0;">
                                Rp. {{ number_format($nota->transaksiPemesanan[0]->total) }}
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-2">
                                <strong>Dibayar</strong>  
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-3" style="padding: 0;">
                                Rp. {{ number_format($nota->transaksiPemesanan[0]->dibayar) }}
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-2">
                                <strong>Sisa</strong>  
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-3" style="padding: 0;">
                                Rp. {{ number_format($nota->transaksiPemesanan[0]->sisa) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('cetakPDF', $nota->id) }}" class="btn app-btn-primary">Cetak</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    @foreach ($pemesanan as $nota)
    <!-- Modal -->
        <div class="modal fade modal-nota" id="staticBackdrop-{{ $nota->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nota Transaksi </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <strong>Tanggal</strong>  
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-9" style="padding: 0;">
                                {{ date('d-m-Y', strtotime($nota->detailPemesanan[0]->pemesanan->tanggal)) }}
                            </div>
                            <div class="col-md-2">
                                <strong>Kasir</strong>
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-9" style="padding: 0;">
                                {{ $nota->user->nama }}
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell ">Nama Menu</th>
                                        <th class="cell ">Jumlah</th>
                                        <th class="cell ">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailPemesanan as $p)
                                        @if ($p->id_pemesanan == $nota->id)
                                            <tr>
                                                <td class="cell">{{ $p->dataMenu->nama_menu }}</td>
                                                <td class="cell">{{ number_format($p->jumlah) }}</td>
                                                <td class="cell">Rp. {{ number_format($p->sub_total) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-6"></div>
                            <div class="col-md-2">
                                <strong>Total</strong>  
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-3" style="padding: 0;">
                                Rp. {{ number_format($nota->transaksiPemesanan[0]->total) }}
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-2">
                                <strong>Dibayar</strong>  
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-3" style="padding: 0;">
                                Rp. {{ number_format($nota->transaksiPemesanan[0]->dibayar) }}
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-2">
                                <strong>Sisa</strong>  
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-3" style="padding: 0;">
                                Rp. {{ number_format($nota->transaksiPemesanan[0]->sisa) }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('cetakPDF', $nota->id) }}" class="btn app-btn-primary">Cetak</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection