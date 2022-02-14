@extends('layouts.main')
@section('content')
    
<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">Selamat Datang, {{ auth()->user()->nama }}!</h3>
            <div class="row gx-5 gy-3">
                <div class="col-12 col-lg-9">
                    <div>Silahkan memilih menu di sebelah kiri halaman untuk mengelola website anda.</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection