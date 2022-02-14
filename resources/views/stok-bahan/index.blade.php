@extends('layouts.main')
@section('content')

<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Stok Bahan</h4>
    </div>
</div>

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">						    
                    <a class="btn app-btn-secondary" href="{{ route('stok-bahan.create') }}">
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-3">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr class="table-custom">
                                <th class="cell text-white">No.</th>
                                <th class="cell text-white">Nama Bahan</th>
                                <th class="cell text-white">Stok</th>
                                <th class="cell text-white">Harga</th>
                                <th class="cell text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stokBahan as $key => $bahan)
                                <tr>
                                    <td class="cell">{{ $stokBahan->firstItem() + $key }}.</td>
                                    <td class="cell">{{ $bahan->nama }}</td>
                                    <td class="cell">{{ $bahan->stok }}</td>
                                    <td class="cell">Rp. {{ number_format($bahan->harga) }}</td>
                                    <td class="cell">
                                        <a href="{{ route('stok-bahan.edit', $bahan->id) }}" class="btn btn-edit btn-sm">Update</a>
                                        <form action="{{ route('stok-bahan.destroy', $bahan->id) }}" method="POST" style="display: inline;"> 
                                        @csrf 
                                        @method('delete')
                                            <button type="submit" class="btn btn-hapus btn-sm" onclick="return confirm('Apakah anda yakin ?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>		
        </div>
        {{ $stokBahan->links() }}
    </div>
</div>

@endsection