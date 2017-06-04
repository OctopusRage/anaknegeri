@extends('layouts.blank')
@section('title', '403 Forbidden Access')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card card-outline-danger" style="width:44%">
                    <div class="card-block text-center">
                        <div>
                            <h2 class="mt-5">403 Forbidden Access</h2>
                            <h1 class="mt-5 mb-5 text-danger text-strong">

                                <i class="icon-user-unfollow"></i>
                            </h1>
                            <p>Maaf, anda tidak memiliki akses ke halaman ini</p>
                            <a href="{{ route('home')}}" class="btn btn-primary mt-3 mb-5">Kembali ke beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
