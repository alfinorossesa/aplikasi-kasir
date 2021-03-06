<div class="mb-3">
    <label for="nama" class="form-label">Nama Bahan</label>
    <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $stokBahan->nama) }}" required placeholder="Masukkan Nama Bahan">
    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="stok" class="form-label">Stok</label>
    <input type="text" class="form-control  @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $stokBahan->stok) }}" required placeholder="Masukkan Stok">
    @error('stok')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="harga" class="form-label">Harga</label>
    <input type="number" class="form-control  @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $stokBahan->harga) }}" required placeholder="Masukkan Harga">
    @error('harga')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<button type="submit" class="btn app-btn-primary">Simpan</button>
<a href="{{ route('stok-bahan.index') }}" class="btn app-btn-secondary">Batal</a>