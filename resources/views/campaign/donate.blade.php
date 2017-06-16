@extends('layouts.app')
@section('title','Berikan Dukungan pada Campaign')
@section('content')
	@include('components.jumbotron-donate')
	<div class="container pt-0" style="top:-50px !important;">
		@include('components.campaign-donate')
	</div>
@endsection