<div class="mb-3">
    <label for="nama_kategori" class="form-label">Nama Kategori</label>
    <input type="text" class="form-control  @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $dataKategoriMenu->nama_kategori) }}" required placeholder="Masukkan Nama Kategori">
    @error('nama_kategori')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<button type="submit" class="btn app-btn-primary">Simpan</button>
<a href="{{ route('data-kategori-menu.index') }}" class="btn app-btn-secondary">Batal</a>