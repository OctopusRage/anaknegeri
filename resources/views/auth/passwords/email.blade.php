@extends('auth.layouts.app')
@section('title', 'Login')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-block p-4">
                        <h1>Reset Password</h1>
                        <p class="text-muted">Silakan masukan email anda</p>
                      
                        {!! Form::open(['url' => url('/password/email'),  'role' =>'form' ]) !!}
                        @include('components.status')
                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  mb-3">

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
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-danger">Kirim Prosedur Reset Password</button>
                        {!! Form::close()!!}

                        <h6 class="mt-3"><a href="{{route('login')}}" class="text-muted"><i class="icon-arrow-left-circle"></i>&nbsp; Kembali ke Login</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
