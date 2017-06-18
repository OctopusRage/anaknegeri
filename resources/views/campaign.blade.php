@extends('layouts.app')
@section('title','Anaknegeri')
@section('content')
	<div class="jumbotron jumbotronfluid mb-0 bg-aqua">
		<div class="container">
			<div class="row">
				<div class="col-md-12 mb-4">
					<h3 class="float-left">Campaign Terbaru</h3>
					<ul class="nav justify-content-end text-uppercase">
					  <li class="nav-item">
					    <a class="nav-link {{ Request::url() == route('campaign.home')? 'active' : null }}" href="{{route('campaign.home')}}">Semua</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link {{ Request::url() == route('campaign.popular')? 'active' : null }}" href="{{route('campaign.popular')}}">Populer</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link {{ Request::url() == route('campaign.category', ['beasiswa'])? 'active' : null }}" href="{{ route('campaign.category', ['beasiswa'])}}">Beasiswa</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link  {{ Request::url() == route('campaign.category', ['kelompok-belajar'])? 'active' : null }}" href="{{ route('campaign.category', ['kelompok-belajar'])}}">Kelompok Belajar</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link  {{ Request::url() == route('campaign.category', ['indonesia-berkarya'])? 'active' : null }}" href="{{ route('campaign.category', ['indonesia-berkarya'])}}">Indonesia Berkarya</a>
					  </li>
					</ul>
				</div>
				@if(Request::segment(2)=='category')
					<div class="col-md-12 mb-3">
						<h5>Kategori : 
							<strong class="text-success">
								{{ $category->category }}
							</strong> 
							</h5>
					</div>
				@endif
				
				<div class="col-md-12">
					<div class="card-columns" id="campaign-data" >
						@include('components.campaign')
					</div>
				</div>
				<div class="col-md-12 text-center">
					<center>
						<button type="button" id="loadMore" class="btn btn-lg btn-primary">Muat Selanjutnya...</button>
					<!-- {{ $campaigns->links('vendor.pagination.bootstrap-4')}}		 -->
					</center>	
				</div>

			</div>
		</div>
	</div>
@endsection
@section('pluginjs')
<script type="text/javascript">
		var page = 1;

		$('#loadMore').click(function(){
			page++;
			loadMoreData(page);
			console.log(page);
		});

		function loadMoreData(page){
		  $.ajax(
		        {
		            url: '?page=' + page,
		            type: "GET",
		            beforeSend: function()
		            {
		                $('#loadMore').html('<i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...');
		            }
		        })
		        .done(function(data)
		        {
		        	console.log(data);
		            if(data.html == ""){
		                $('#loadMore').html('Semua data telah dimuat...');
		                $('#loadMore').attr("disabled", "disabled");
		                return;
		            }
		            $('#loadMore').html('Muat Selanjutnya...');
		            $("#campaign-data").append(data.html);
		        })
		        .fail(function(jqXHR, ajaxOptions, thrownError)
		        {
		              alert('Server tidak merespon...');
		        });
		}

		
</script>
@endsection