@extends('layouts.blank')
@section('title', 'Aktivasi Akun Sukses')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card card-outline-success" style="width:44%">
                    <div class="card-block text-center">
                        <div>
                            <h2 class="mt-5">Aktivasi akun sukses</h2>
                            <h1 class="mt-5 mb-5 text-success text-strong">

                                <i class="icon-check"></i>
                            </h1>
                            <p>Selamat, akun anda telah aktif!</p>
                            <a href="{{ route('home')}}" class="btn btn-success mt-3 mb-5">Mulai Campaign</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
