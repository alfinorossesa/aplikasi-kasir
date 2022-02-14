@extends('layouts.main')
@section('content')
    
<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Transaksi Pemesanan</h4>
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
                                        <td class="cell">{{ date('d-m-Y', strtotime($p->pemesanan->tanggal)) }}</td>
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
            <form class="settings-form" action="{{ route('pemesanan.transaksiPemesananStore') }}" method="POST">
            @csrf
                <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id }}">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="total" class="form-label label-pembayaran">Total</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="total" name="total" value="{{ $jumlah }}" required placeholder="harga Total">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="dibayar" class="form-label label-pembayaran">Dibayar</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="dibayar" name="dibayar" value="" autofocus required placeholder="Jumlah Dibayar">
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisa" class="form-label label-pembayaran">Sisa</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="sisa" name="sisa" value="" required placeholder="Sisa">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <button id="simpan1" type="submit" class="btn app-btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>

        $(document).ready(function() {

            $('#dibayar').keyup(function(){
                var total = $('#total').val();
                var dibayar = $('#dibayar').val();
                var sisa = total - dibayar;

                $('#sisa').val(sisa);

                if (sisa <= 0) {
                    var sisa = dibayar - total;
                    $('#sisa').val(sisa);
                }
            });

        });

    </script>
@endpush