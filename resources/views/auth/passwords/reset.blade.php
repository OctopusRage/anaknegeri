@extends('auth.layouts.app')
@section('title', 'Login')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-block p-4">
                        <h1>Reset Password</h1>
                        <p class="text-muted">Silakan masukan password baru</p>
                      
                        {!! Form::open(['url' => url('/password/reset/'),  'role' =>'form' ]) !!}
                        @include('components.status')
                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  mb-3">

                            <label for="email">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-envelope"></i></span>
                                {!! Form::email('email', null, [
                                    'class'                         => 'form-control',
                                    'placeholder'                   => 'Email address',
                                    'required',
                                    'autofocus',
                                    'id'                            => 'email'
                                ]) !!}
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}  mb-3">

                            <label for="password">Password Baru</label>
                            <div class="input-group">
                                 <span class="input-group-addon"><i class="icon-lock"></i></span>
                            {!! Form::password('password', [
                                'class'                         => 'form-control',
                                'placeholder'                   => 'Password',
                                'required',
                                'id'                            => 'password'
                            ]) !!}

                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}  mb-3">

                            <label for="password">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                 <span class="input-group-addon"><i class="icon-lock"></i></span>
                                {!! Form::password('password_confirmation', [
                                    'class'                         => 'form-control',
                                    'placeholder'                   => 'Password',
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

                        <button type="submit" class="btn btn-primary">Reset Password</button>

                        {!! Form::close()!!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
