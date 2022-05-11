@extends('layouts.main')
@section('content')
    
<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Buat Pesanan</h4>
    </div>
</div>

{{-- id pemesanan --}}
<?php
    $idPemesanan = 1;
?>

<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
            <form class="settings-form" action="{{ route('pemesanan.store') }}" method="POST" id="myForm">
            @csrf
                @if ($pemesanan == null)
                    <input type="hidden" name="id_pemesanan" value="{{ $idPemesanan++ }}">
                @elseif ($pemesanan !== null)
                    <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id + 1 }}">
                @endif
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="id_dataKategoriMenu" class="form-label">Pilih Kategori</label>
                    @foreach ($dataKategoriMenu as $kategori)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input categories-checkbox" name="id_dataKategoriMenu[]" value="{{ $kategori->id }}">
                            <label for="defaultCheck2" class="form-check-label">{{ $kategori->nama_kategori }}</label>
                        </div>
                    @endforeach
                    @if ($errors->has('id_dataKategoriMenu'))
                        <span class="text-danger">Silahkan pilih kategori</span>
                    @endif
                </div>

                <hr>
                @csrf
                <div id="menu-container"></div>

                <div class="alert alert-info m-0 mb-3">
                    <div class="row">
                        <input style="display: none;" type="text" id="hargaTotalValidate" required>
                        <div class="col-md-8"><strong>Harga Total</strong></div>
                        <div class="col-md-4"><strong>Rp. <span id="hargaTotal">0</span></strong></div>
                    </div>
                </div>

                <button type="submit" id="submitCoba" class="btn app-btn-primary">Simpan</button>
                <a href="{{ route('pemesanan.index') }}" class="btn app-btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>

        $(document).ready(function() {
            
            $('.categories-checkbox').change(function() {
                if(this.checked) {
                    const id = $(this).val();
                    getMenuByCategory(id);
                } else {
                    const id = $(this).val();
                    unselectMenu(id);
                }
            });

        });

        function getMenuByCategory(id) {
            let url = "{{ route('menu.get', ':id') }}";
            url = url.replace(':id', id);

            $.get(url).done(function (response) {
                let menus = response.data;
                if(menus.length == 0) {
                    $('#menu-container').html('tidak ada data');
                }
                let asd = '';
                menus.forEach(menu => {
                    asd += `
                        <div class="menu-`+ menus[0].data_kategori_menu.id +`">
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/images/${menu.photo}') }}" alt="photo" style="width: 100px; height: 100px; padding: 5px;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="card-title">${menu.nama_menu}</h5>
                                                    <span>Rp. ${menu.harga}</span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" style="display: none;" placeholder="Jumlah" id="qty-${menu.id}" name="jumlah[qty][${menu.id}]">
                                                        <div class="input-group-append mt-3">
                                                            <button class="mx-1 btn app-btn-secondary jumlahButton" type="button" onclick="return decreaseQty(${menu.id})">-</button>
                                                            <h5 id="jumlahMenu-${menu.id}" class="jumlahMenu">0</h5>
                                                            <button class="btn app-btn-secondary" type="button" onclick="return increaseQty(${menu.id})">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $('#menu-container').append(`<h5 class="form-label mb-3 menu-`+ menus[0].data_kategori_menu.id +`">${menus[0].data_kategori_menu.nama_kategori}</h5>`+ asd);
            });
        }

        function unselectMenu(id) {
            let url = "{{ route('menu.get', ':id') }}";
            url = url.replace(':id', id);

            $.get(url).done(function (response) {
                let menus = response.data;
                kategoriName = menus[0].data_kategori_menu.id;
                if (kategoriName == id) {
                    $('.menu-'+id).html('');
                }
            });
        }

        function increaseQty(id){
            let inputQty = $(`#qty-${id}`);
            let value = inputQty.val();
            if(value.length == 0) {
                value = 0;
            }
            $(`#qty-${id}`).val(parseInt(value)+1);
            $(`#jumlahMenu-${id}`).html(parseInt(value)+1);

            let formData = $('#myForm').serialize();
            console.log(formData);
            
            $.get(`{{ route('total_amount.get') }}`, formData).done(function(data) {
                $('#hargaTotal').text(data.total_amount)
                $('#hargaTotalValidate').val(data.total_amount)
            });
        }

        function decreaseQty(id){
            let inputQty = $(`#qty-${id}`);
            let value = inputQty.val();
            if(value > 0){
                $(`#qty-${id}`).val(parseInt(value)-1);
                $(`#jumlahMenu-${id}`).html(parseInt(value)-1);
            }

            let formData = $('#myForm').serialize();
            $.get(`{{ route('total_amount.get') }}`, formData).done(function(data) {
                $('#hargaTotal').text(data.total_amount)
                $('#hargaTotalValidate').val(data.total_amount)
            });                
        }

    </script>
@endpush