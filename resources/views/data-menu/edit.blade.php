@extends('layouts.main')
@section('content')
    
<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Tambah Data Menu</h4>
    </div>
</div>

<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
            <form class="settings-form" action="{{ route('data-menu.update', $dataMenu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <input type="hidden" name="kategori" id="kategori" value="{{ $dataMenu->kategori }}">
                <div class="mb-3">
                    <label for="id_dataKategoriMenu" class="form-label">Pilih Kategori Menu</label>
                    <select class="form-select @error('id_dataKategoriMenu') is-invalid @enderror" id="id_dataKategoriMenu" name="id_dataKategoriMenu" required>
                        @if ($dataMenu->id_dataKategoriMenu)
                            <option disabled>Pilih Kategori Menu</option>
                            @foreach ($dataKategoriMenu as $kategori)
                                <option value="{{ $kategori->id }}" {{ $kategori->id == $dataMenu->id_dataKategoriMenu ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('id_dataKategoriMenu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama_menu" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control  @error('nama_menu') is-invalid @enderror" id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $dataMenu->nama_menu) }}" required placeholder="Masukkan Nama Menu">
                    @error('nama_menu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control  @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $dataMenu->harga) }}" required placeholder="Masukkan Harga">
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Add Photo</label>
                    <input type="hidden" name="oldImage" value="{{ $dataMenu->photo }}">
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" onchange="previewImage()">
                    @if ($dataMenu->photo)
                            <img src="{{ asset('storage/images/' . $dataMenu->photo) }}" class="img-preview img-fluid mt-3 col-sm-2 d-block">
                        @else               
                            <img class="img-preview img-fluid mt-3 col-sm-2">
                        @endif
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn app-btn-primary">Simpan</button>
                <a href="{{ route('data-menu.index') }}" class="btn app-btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>

        $(document).ready(function() {

            $('#id_dataKategoriMenu').change(function(){
                var id = $(this).val();
                var url = "{{ route('json.dataKategoriMenu', ':id') }}";
                url=url.replace(':id',id);

                $.get( url, function( data ) {
                    $('#kategori').val(data.nama_kategori);
                });
        
            })
            
        });

        function previewImage() {
            const image = document.querySelector('#photo');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

    </script>
@endpush