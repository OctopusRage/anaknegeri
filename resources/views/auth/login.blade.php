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
                            
                         {!! Form::open(['url' => url('login'),  'role' =>'form' ]) !!}
                            
                            @include('components.status')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}  mb-3">

                            <label for="inputEmail">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-envelope"></i></span>
                                {!! Form::email('email', null, [
                                    'class'                         => 'form-control',
                                    'placeholder'                   => 'Email address',
                                    'required',
                                    'id'                            => 'inputEmail'
                                ]) !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}  mb-3">

                            <label for="inputPassword">Password</label>
                            <div class="input-group">
                                 <span class="input-group-addon"><i class="icon-lock"></i></span>
                            {!! Form::password('password', [
                                'class'                         => 'form-control',
                                'placeholder'                   => 'Password',
                                'required',
                                'id'                            => 'inputPassword'
                            ]) !!}

                            </div>
                        </div>
                        <div class="checkbox">
                            <label class="switch switch-sm switch-icon switch-primary-outline-alt checkbox-inline mb-1">
                                <input type="checkbox" class="switch-input" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                                <span class="switch-label" data-on="" data-off=""></span>
                                <span class="switch-handle"></span>
                            </label>
                            <label class="switch">
                                Ingat Password
                            </label>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4">Login</button>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('password.request')}}" class="btn btn-link px-0">Forgot password?</a>
                            </div>
                        </div>
                        {!! Form::close() !!}

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
                            <a href="{{ route('register')}}" class="btn btn-info mt-3">Register Now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
