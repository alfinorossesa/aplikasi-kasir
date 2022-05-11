@extends('layouts.main')
@section('content')
    
<div class="app-card alert shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <h4 class="title-head">Edit Data Kasir</h4>
    </div>
</div>

<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
            <form class="settings-form" action="{{ route('data-kasir.update', $dataKasir->id) }}" method="POST">
            @csrf
            @method('PUT')
                @include('data-kasir._form')
            </form>
        </div>
    </div>
</div>

@endsection