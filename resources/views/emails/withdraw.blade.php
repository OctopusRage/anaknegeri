@extends('layouts.blank')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card card-outline-primary" style="width:44%">
                    <div class="card-block text-center">
                        <div>
                            <h2 class="mt-5">Hallo, {{ $name }}</h2>
                            <h1 class="mt-5 mb-5 text-success text-strong">

                                <i class="icon-check"></i>
                            </h1>
                            <p>Permintaan penarikan dukungan anda telah {{ $status }} oleh admin</p>
                            <p>Detail penarikan</p>
                            <p>{{$item}} sebanyak {{$amount}}</p>
                            <p>Dukungan sedang diproses untuk segera dikirimkan</p>
                            <a href="{{ route('home') }}" class="btn btn-primary mt-3 mb-5">Kembali ke Website</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
