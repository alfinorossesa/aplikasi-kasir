<input type="hidden" name="role" value="admin">
<div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $dataAdmin->nama) }}" required placeholder="Masukkan Nama Admin">
    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $dataAdmin->username) }}" required placeholder="Masukkan Username">
    @error('username')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="no_telepon" class="form-label">No. Telepon</label>
    <input type="number" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $dataAdmin->no_telepon) }}" placeholder="Masukkan No. Telepon">
    @error('no_telepon')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="password" class="form-label">Buat Password Baru</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukkan Password Baru">
    @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<button type="submit" class="btn app-btn-primary">Simpan</button>
<a href="{{ route('data-admin.index') }}" class="btn app-btn-secondary">Batal</a>