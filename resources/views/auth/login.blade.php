@extends('auth.layouts.app')
@section('title', 'Login')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card p-4">
                    <div class="card-block">

                        <h1>Login</h1>
                        <p class="text-muted">Silakan masukan email dan password</p>
                         <div class="form-group  mb-3">

                            <label for="name">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-envelope"></i></span>
                                <input type="text" class="form-control" placeholder="Email">
                            </div>
                            <span class="help-block">Pesan error</span>
                        </div>
                        <div class="form-group  mb-3">

                            <label for="name">Password</label>
                            <div class="input-group">
                                 <span class="input-group-addon"><i class="icon-lock"></i>
                            </span>
                            <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <span class="help-block">Pesan error</span>
                        </div>
                        <div class="checkbox">
                            <label class="switch switch-sm switch-icon switch-primary-outline-alt checkbox-inline mb-1">
                                <input type="checkbox" class="switch-input "> 
                                <span class="switch-label" data-on="" data-off=""></span>
                                <span class="switch-handle"></span>
                            </label>
                            <label class="switch">
                                Ingat Password
                            </label>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary px-4">Login</button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-link px-0">Forgot password?</button>
                            </div>
                        </div>

                        <h6><a href="/" class="text-muted"><i class="icon-arrow-left-circle"></i>&nbsp; Kembali ke Beranda</a></h6>
                    </div>
                </div>
                <div class="card card-inverse card-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-block text-center">
                        <div>
                            <h2>Register</h2>
                            <h2 class="mt-4 mb-4">
                                <i class="icon-people"></i>
                            </h2>
                            <p>Bergabung dengan komunitas peduli pemerataan pendidikan Indonesia dan karya anak bangsa. </p>
                            <button type="button" class="btn btn-info mt-3">Register Now!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
