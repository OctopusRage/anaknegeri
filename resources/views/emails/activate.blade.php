@extends('layouts.blank')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card card-outline-primary" style="width:44%">
                    <div class="card-block text-center">
                        <div>
                            <h2 class="mt-5">Hallo, {{$name}}</h2>
                            <h1 class="mt-5 mb-5 text-success text-strong">

                                <i class="icon-check"></i>
                            </h1>
                            <p>Klik tombol berikut untuk aktivasi akun</p>
                            <a href="{{ url('/activate', ['token'=>$token]) }}" class="btn btn-primary mt-3 mb-5">Aktivasi!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
