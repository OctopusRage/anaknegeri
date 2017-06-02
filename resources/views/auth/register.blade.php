@extends('auth.layouts.app')
@section('title', 'Login')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-block p-4">
                        <h1>Register</h1>
                        <p class="text-muted">Silakan masukkan data diri anda</p>
                      
                        <div class="form-group  mb-3">
                            <label for="name">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Nama Lengkap">
                            </div>
                            <span class="help-block">Pesan error</span>
                        </div>
                       
                        <div class="form-group  mb-3">

                            <label for="name">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-envelope"></i></span>
                                <input type="text" class="form-control" placeholder="Email">
                            </div>
                            <span class="help-block">Pesan error</span>
                        </div>
                        <div class="form-group  mb-3">

                            <label for="name">Passworrd</label>
                            <div class="input-group">
                                 <span class="input-group-addon"><i class="icon-lock"></i>
                            </span>
                            <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <span class="help-block">Pesan error</span>
                        </div>
                       <div class="form-group  mb-3">  

                            <label for="name">Ulangi Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Ulangi password">
                            </div>
                           <span class="help-block">Pesan error</span>
                        </div>
                       
                        <button type="button" class="btn btn-block btn-success">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
