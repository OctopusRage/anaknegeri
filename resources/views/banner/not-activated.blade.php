@extends('layouts.blank')
@section('title', 'Akun belum diaktivasi')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card card-outline-secondary" style="width:44%">
                    <div class="card-block text-center">
                        <div>
                            <h2 class="mt-5">Akun belum diaktivasi</h2>
                            <h1 class="mt-5 mb-5 text-muted text-strong">

                                <i class="icon-close"></i>
                            </h1>
                            <p>Silakan lakukan aktivasi berdasarkan prosedur yang telah kami kirim.</p>
                            <a href="{{ route('authenticated.activation-resend') }}" class="btn btn-secondary mt-3 mb-5">Resend Email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
