@extends('layouts.app')
@section('title','Anaknegeri')
@section('content')
	<div class="container pt-4">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				@include('components.profile.profile-nav')
			</div>
			<div class="col-md-9 col-sm-12">
				@include('components.profile.profile-content')
			</div>
		</div>
	</div>
@endsection