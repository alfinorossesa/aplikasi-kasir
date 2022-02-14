@extends('layouts.main')
@section('content')
    
<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Tambah Data Kategori Menu</h4>
    </div>
</div>

<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
            <form class="settings-form" action="{{ route('data-kategori-menu.store') }}" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control  @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}" required placeholder="Masukkan Nama Kategori">
                    @error('nama_kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn app-btn-primary">Simpan</button>
                <a href="{{ route('data-kategori-menu.index') }}" class="btn app-btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

@endsection