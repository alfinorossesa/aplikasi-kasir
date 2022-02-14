@extends('layouts.main')
@section('content')

<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Data Kategori Menu</h4>
    </div>
</div>

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">						    
                    <a class="btn app-btn-secondary" href="{{ route('data-kategori-menu.create') }}">
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
                                <th class="cell text-white">Nama Kategori</th>
                                <th class="cell text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataKategoriMenu as $key => $kategori)
                                <tr>
                                    <td class="cell">{{ $dataKategoriMenu->firstItem() + $key }}.</td>
                                    <td class="cell">{{ $kategori->nama_kategori }}</td>
                                    <td class="cell">
                                        <a href="{{ route('data-kategori-menu.edit', $kategori->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                        <form action="{{ route('data-kategori-menu.destroy', $kategori->id) }}" method="POST" style="display: inline;"> 
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
        {{ $dataKategoriMenu->links() }}
    </div>
</div>

@endsection