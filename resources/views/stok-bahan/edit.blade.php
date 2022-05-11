@extends('layouts.main')
@section('content')
    
<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Update Stok Bahan</h4>
    </div>
</div>

<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
            <form class="settings-form" action="{{ route('stok-bahan.update', $stokBahan->id) }}" method="POST">
            @csrf
            @method('PUT')
                @include('stok-bahan._form')
            </form>
        </div>
    </div>
</div>

@endsection
