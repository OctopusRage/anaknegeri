@extends('layouts.app')
@section('title','Anaknegeri')
@section('content')

	@include('components.organisasi.jumbotron')

	<div class="container mb-5 pt-0" style="top:-50px !important;">
		
		@include('components.organisasi.content')
	</div>

@endsection