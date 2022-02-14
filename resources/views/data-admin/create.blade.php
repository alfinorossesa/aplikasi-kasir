@extends('layouts.main')
@section('content')
    
<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Tambah Data Admin</h4>
    </div>
</div>

<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
            <form class="settings-form" action="{{ route('data-admin.store') }}" method="POST">
            @csrf
                <input type="hidden" name="role" value="admin">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan Nama Admin">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required placeholder="Masukkan Username">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No. Telepon</label>
                    <input type="number" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Masukkan No. Telepon">
                    @error('no_telepon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn app-btn-primary">Simpan</button>
                <a href="{{ route('data-admin.index') }}" class="btn app-btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

@endsection