@extends('layouts.app')
@section('title','Anaknegeri')
@section('content')
	
	@include('banner.status')

	@include('components.jumbotron')
	<div class="jumbotron jumbotronfluid pt-5 mb-0 mt-0 bg-white">
		<div class="container">
			
		@include('components.category')
		</div>
		
	</div>
	<div class="jumbotron jumbotronfluid mb-0 bg-aqua">
		<div class="container">
			<div class="row">
				<div class="col-md-12 mb-4 text-center">
					<h3 clas>Campaign Terbaru</h3>
				</div>
				@foreach($campaigns as $campaign)
					<div class="col">
						@include('components.campaign')
					</div>
				@endforeach
				<div class="col-md-12">
					
					<p class="text-center">
						<a href="{{ route('campaign.home')}}" class="btn btn-primary">Lihat semua...</a>
					</p>
				</div>

			</div>
		</div>
	</div>
@endsection