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
                @include('data-kategori-menu._form')
            </form>
        </div>
    </div>
</div>

@endsection