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
					
					<div class="col-md-4">
						<div class="card mb-4" >
							<div class="embed-responsive embed-responsive-1by1">
							  <div class="embed-responsive-item" src="/">  
							  	<img class="card-img-top" @if($campaign->feature_img!=null) src="{{ asset('img/campaigns/thumbs')}}/{{ $campaign->feature_img }}" @else src="{{ asset('img/bg-primary.png' )}}"  style="backgroud-color:#63c2de !important" @endif alt="Card image cap">
								</div>
							</div>
						    <div class="progress">
						      <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
						    </div>
						  <div class="card-block">
						    <h4 class="card-title">{{ $campaign->title }}</h4>
						    <p>
						    	<small>
						    		<i class="icon-user"></i>
						    		<span>{{ $campaign->user->name }}</span>

						    		<i class="icon-calendar pl-4"></i>
						    		<span><?php echo date('D, d M Y', strtotime($campaign->deadline)); ?></span>
						    	</small>
						    </p>    
						    <p>
						        <strong class="text-success">
						            <span class="icon-tag"></span>
						            {{ $campaign->category->category }}
						        </strong>        
						    </p>
						    <p class="card-text">{{ $campaign->subtitle }}.</p>
						    <p>Kebutuhan</p>
						    <table class="table table-sm table-bordered" >
						        <tbody>
						             @foreach($campaign->supportType as $st)
						            <tr>
						                <td class="bg-inverse">{{ $st->pivot->item }}</td>
						                <td>@if($st->pivot->item == "Dana") Rp. @endif {{ $st->pivot->amount }}</td>
						            </tr>            
						            @endforeach
						        </tbody>
						    </table>
						   
						  </div>

						    <div class="card-footer"> 
						        <a href="{{ route('campaign.detail', [$campaign->slug] )}}" class="btn btn-info ">Detail</a>
						    </div>
						</div>
					</div>
					@endforeach

				<div class="col-md-12">
					
					<p class="text-center">
						<a href="{{ route('campaign.home')}}" class="btn btn-lg btn-primary">Lihat semua...</a>
					</p>
				</div>

			</div>
		</div>
	</div>
@endsection