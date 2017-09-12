@extends('auth.layouts.app')
@section('title', 'Register')
@section('plugincss')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-block p-4">
                        <h1>Register</h1>
                        <p class="text-muted">Silakan masukkan data diri anda</p>
                         {!! Form::open(['url' => url('register'),  'role' =>'form' ]) !!}
                            @include('components.status')
                                
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}  mb-3">
                                <label for="inputFullName">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                </span>

                                {!! Form::text('name', null, [
                                        'class'                         => 'form-control',
                                        'placeholder'                   => 'Nama Lengkap',
                                        'required',
                                        'id'                            => 'inputFullName'
                                    ]) !!}
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                           
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  mb-3">

                                <label for="inputEmail">Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-envelope"></i></span>
                                    {!! Form::email('email', null, [
                                        'class'                         => 'form-control',
                                        'placeholder'                   => 'Alamat Email',
                                        'required',
                                        'id'                            => 'inputEmail'
                                    ]) !!}
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}  mb-3">

                                <label for="inputPassword">Passworrd</label>
                                <div class="input-group">
                                     <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                {!! Form::password('password', [
                                    'class'                         => 'form-control',
                                    'placeholder'                   => 'Password',
                                    'required',
                                    'id'                            => 'inputPassword'
                                ]) !!}

                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                           <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}  mb-3">  

                                <label for="name">Ulangi Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    {!! Form::password('password_confirmation', [
                                        'class'                         => 'form-control',
                                        'placeholder'                   => 'Konfirmasi Password',
                                        'required',
                                        'id'                            => 'password-confirm'
                                    ]) !!}

                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- <div class="g-recaptcha mb-3" data-sitekey="6LfgGCQUAAAAAKi0uWSrcWz-fmNXSOX2pTC62-J9">
                                
                            </div> -->
                            {!! Recaptcha::render() !!}

                            <button type="submit" class="btn btn-block btn-primary">Register</button>

                        {!! Form::close() !!}
                        <h6 class="mt-3"><a href="/" class="text-muted"><i class="icon-arrow-left-circle"></i>&nbsp; Kembali ke Beranda</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
