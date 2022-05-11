@extends('layouts.main')
@section('content')

<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Laporan Transaksi</h4>
    </div>
</div>

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
         <div class="page-utilities">
            <form action="{{ url('laporan') }}" method="POST" class="table-search-form row gx-1 align-items-center">
            @csrf
                <div class="col-auto">
                    <label for="dari_tanggal" class="filter-tanggal">Dari Tanggal</label>
                    <input type="date" class="form-control search-orders mb-2" id="dari_tanggal" name="dari_tanggal" required value="{{ request('dari_tanggal') }}">
                    <label for="sampai_tanggal" class="filter-tanggal">Sampai Tanggal</label>
                    <input type="date" class="form-control search-orders mb-4" id="sampai_tanggal" name="sampai_tanggal" required value="{{ request('sampai_tanggal') }}">
                </div>
                <div>
                    <button type="submit" name="submit" value="submit" class="btn app-btn-primary print">Atur Tanggal</button>
                    <a href="{{ route('laporan.index') }}" class="btn app-btn-secondary print">Semua Laporan</a>
                </div>
            </form>
        </div>
    </div>
</div>
    
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr class="table-custom">
                                <th class="cell text-white">No.</th>
                                <th class="cell text-white">Tanggal</th> 
                                <th class="cell text-white">Nama Kasir</th>
                                <th class="cell text-white">Nama Menu</th>
                                <th class="cell text-white">Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (request()->has('submit'))
                                @foreach ($filterPemesanan as $p)
                                    <tr>
                                        <td class="cell">{{ $loop->iteration }}.</td>
                                        <td class="cell">{{ date('d-m-Y', strtotime($p->detailPemesanan[0]->pemesanan->tanggal)) }}</td>
                                        <td class="cell">{{ $p->user->nama }}</td>
                                        <td class="cell">{{ $p->detailPemesanan[0]->dataMenu->nama_menu }}</td>
                                        <td class="cell">Rp. {{ number_format($p->transaksiPemesanan[0]->total) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach ($pemesanan as $p)
                                <tr>
                                    <td class="cell">{{ $loop->iteration }}.</td>
                                    <td class="cell">{{ date('d-m-Y', strtotime($p->detailPemesanan[0]->pemesanan->tanggal)) }}</td>
                                    <td class="cell">{{ $p->user->nama }}</td>
                                    <td class="cell">{{ $p->detailPemesanan[0]->dataMenu->nama_menu }}</td>
                                    <td class="cell">Rp. {{ number_format($p->transaksiPemesanan[0]->total) }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>		
        </div>
    </div>
</div>

{{-- total harga --}}
<?php 
    $jumlah = 0;
?>

<div style="display: none;">
    @if (request()->has('submit'))
        @foreach ($filterPemesanan as $p)
            <p>{{ $p->transaksiPemesanan[0]->total }}</p>
            <p><?php $jumlah += $p->transaksiPemesanan[0]->total ?></p>
        @endforeach
    @else
        @foreach ($pemesanan as $p)
            <p>{{ $p->transaksiPemesanan[0]->total }}</p>
            <p><?php $jumlah += $p->transaksiPemesanan[0]->total ?></p>
        @endforeach
    @endif
</div>

<div class="row g-3 mb-5 align-items-center justify-content-end">
    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">						    
                    <label class="form-label label-pembayaran">Total Pendapatan</label>
                </div>
                <div class="col-auto">						    
                    <h5 class="totalPendapatan">Rp. {{ number_format($jumlah) }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-5 mt-2 align-items-center justify-content-end print" style="padding-right: 10px;">
    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">						    
                    <a type="button" id="print" class="btn app-btn-primary">
                        Cetak Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $( "#print" ).click(function() {
                window.print();
            });
            
        });

    </script>
@endpush