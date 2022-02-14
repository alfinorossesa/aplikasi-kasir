@extends('layouts.main')
@section('content')

<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Detail Pemesanan</h4>
    </div>
</div>

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h5 class="detail mb-0">Tanggal : {{ date('d-m-Y', strtotime($pemesanan->detailPemesanan[0]->pemesanan->tanggal)) }}</h5>
        <h5 class="detail kasir mb-0">Kasir : {{ $pemesanan->user->nama }}</h5>
    </div>
    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">						    
                    <a class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Cetak Nota
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-4">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr class="table-custom">
                                <th class="cell text-white">No.</th>
                                <th class="cell text-white">Nama Menu</th>
                                <th class="cell text-white">Jumlah</th>
                                <th class="cell text-white">Sub Total</th>
                            </tr>
                        </thead>

                        {{-- nomer --}}
                        <?php
                            $no = 1;
                        ?>

                        <tbody>
                            @foreach ($detailPemesanan as $p)
                                @if ($p->id_pemesanan == $pemesanan->id)
                                    <tr>
                                        <td class="cell">{{ $no++ }}.</td>
                                        <td class="cell">{{ $p->dataMenu->nama_menu }}</td>
                                        <td class="cell">{{ number_format($p->jumlah) }}</td>
                                        <td class="cell">Rp. {{ number_format($p->sub_total) }}</td>
                                    </tr>
                                @endif
                            @endforeach
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
    @foreach ($detailPemesanan as $detail)
        @if ($pemesanan->id == $detail->id_pemesanan)
            <p>{{ $detail->harga }}</p>
            <p><?php $jumlah += $detail->sub_total ?></p>
        @endif
    @endforeach
</div>

<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <div class="app-card-body">
            <form class="settings-form">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="total" class="form-label label-pembayaran">Harga Total</label>
                        </div>
                        <div class="col-md-8">
                            {{-- <input type="number" class="form-control" id="total" name="total" value="{{ $jumlah }}" required placeholder="harga Total"> --}}
                            <span class="totalPendapatan">Rp. {{ number_format($jumlah) }}</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">						    
                    <a class="btn app-btn-secondary" href="{{ route('pemesanan.index') }}">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade modal-nota" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
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
                        {{ date('d-m-Y', strtotime($pemesanan->detailPemesanan[0]->pemesanan->tanggal)) }}
                    </div>
                    <div class="col-md-2">
                        <strong>Kasir</strong>
                    </div>
                    <div class="col-md-1">
                        :
                    </div>
                    <div class="col-md-9" style="padding: 0;">
                        {{ $pemesanan->user->nama }}
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
                                @if ($p->id_pemesanan == $pemesanan->id)
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
                        Rp. {{ number_format($pemesanan->transaksiPemesanan[0]->total) }}
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-2">
                        <strong>Dibayar</strong>  
                    </div>
                    <div class="col-md-1">
                        :
                    </div>
                    <div class="col-md-3" style="padding: 0;">
                        Rp. {{ number_format($pemesanan->transaksiPemesanan[0]->dibayar) }}
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-2">
                        <strong>Sisa</strong>  
                    </div>
                    <div class="col-md-1">
                        :
                    </div>
                    <div class="col-md-3" style="padding: 0;">
                        Rp. {{ number_format($pemesanan->transaksiPemesanan[0]->sisa) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('cetakPDF', $pemesanan->id) }}" class="btn app-btn-primary">Cetak</a>
            </div>
        </div>
    </div>
</div>

@endsection