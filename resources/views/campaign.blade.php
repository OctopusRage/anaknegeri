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
					    <a class="nav-link active" href="#">Semua</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="#">Populer</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="#">Beasiswa</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="#">Kelompok Belajar</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="#">Indonesia Berkarya</a>
					  </li>
					</ul>
				</div>
				<?php for($i=0;$i<12;$i++){ ?>
					<div class="col-md-4">
						@include('components.campaign')
					</div>
					
				<?php 
					}
				?>
				<div class="col-md-12">
					
					<p class="text-center">
						<a href="/" class="btn btn-primary">Lihat semua...</a>
					</p>
				</div>

			</div>
		</div>
	</div>
@endsection