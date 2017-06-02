<div class="jumbotron jumbotron-fluid mb-0 mt-0 bg-inverse text-white">
	<div class="container">
		<div class="row">
			<div class="col">
				<h4 class="mb-4">Tentang kami</h4>
				<div class="media">
				  <img class="d-flex mr-3 rounded-circle" src="{{ asset('img/avatars/6.jpg') }}" alt="Generic placeholder image">
				  <div class="media-body">
				    <h5 class="mt-0">Anaknegeri</h5>
				    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
				    <a href="{{ route('about')}}" class="text-primary">Selengkapnya...</a>
				  </div>
				</div>
			</div>
			<div class="col">
				<h4  class="mb-4">Quick Link</h4>
				<ul class="list-unstyled">
					<li><a href="{{ route('home') }}">Blog</a></li>
					<li><a href=" {{ route('home')}}">Contact</a></li>
					<li><a href="{{ route('term-condition')}}">Syarat dan Ketentuan</a></li>
					<li><a href="{{ route('privacy-policy')}}">Kebijakan Privasi</a></li>
				</ul>
			</div>
			<div class="col">
				<h4  class="mb-4">Hubungi kami</h4>
				<ul class="list-unstyled">
					<li><i class="icon-phone"></i>&nbsp; (0280) 621203</li>
					<li><i class="icon-envelope"></i>&nbsp; support@anaknegeri.com</li>
					<li><i class="icon-map"></i>&nbsp; Bulaksumur Yogyakarta 55281 </li>
				</ul>
			</div>
			<div class="col">
				<h4  class="mb-4">Temukan kami</h4>
				<div class="row">
					@include('components.social')
				</div>
			</div>
		</div>
	</div>
</div>
<div class="jumbotron jumbotron-fluid mb-0 mt-0 pt-1 pb-1" style="background-color: #1c2329;">
	<p class="text-center mt-3 text-muted">Copyright &copy; 2017 Anaknegeri.com</p>
</div>