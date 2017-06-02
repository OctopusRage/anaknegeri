@extends('layouts.app')
@section('title','Detail Campaign')
@section('content')
	@include('components.jumbotron-detail')
	<div class="container mb-5 pt-0" style="top:-50px !important;">
		@include('components.campaign-detail')
    <div class="row mt-3">
        <div class="col-md-6 col-sm-12"><a href="{{route('campaign-donate')}}" class="btn btn-lg btn-block btn-primary">Beri Dukungan Finansial</a></div>
        <div class="col-md-6 col-sm-12"><a href="{{route('campaign-donate')}}" class="btn btn-lg btn-block btn-danger" >Beri Dukungan Lainnya</a></div>
    </div>
	</div>
@endsection