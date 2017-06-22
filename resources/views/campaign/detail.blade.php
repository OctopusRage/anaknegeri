@extends('layouts.app')
@section('title','Detail Campaign')
@section('content')
    @include('components.jumbotron-detail')
    <div class="container pt-0 pb-5" style="top:-50px !important;">
        @include('components.campaign-detail')
    <div class="row mt-3">
        <div class="col-md-6 col-sm-12"><a href="{{route('campaign.donate', [$campaign->slug])}}" class="btn btn-lg btn-block btn-primary">Beri Dukungan</a></div>
       @if (Route::has('login'))
                @if (Auth::check())
        <div class="col-md-6 col-sm-12"><a href="{{route('campaign.create')}}" class="btn btn-lg btn-block btn-success" >Beri Buat Campaign Sendiri</a></div>
        @endif
        @endif
    </div>
    </div>
@endsection
