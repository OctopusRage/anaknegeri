<div class="card">
	<div class="embed-responsive embed-responsive-1by1">
	  <div class="embed-responsive-item" src="/">  
	  	<img class="card-img-top" src="{{ asset('img/feature-home/back_1.JPG') }}" alt="Card image cap">
		</div>
	</div>
	<div class="card-block">
	  <!-- <h4 class="card-title">{{ Auth::user()->name }} @if (Auth::user()->isVerified(true)) <i class="icon-check text-success"></i> @endif</h4> -->
	</div>
	<div class="list-group list-group-flush">
	  <a href="{{ route('profile.home', ['id'=>Auth::user()->id])}}" class="list-group-item  list-group-item-action">
	  	<i class="icon-user"></i> &nbsp;
	    Profile
	  </a>
	  <a href="{{ route('profile-campaign')}}" class="list-group-item list-group-item-action">
	  	<i class="icon-cursor"> </i> &nbsp;
	  	Campaign
	  </a>
	  <a href="{{ route('profile.wallet')}}" class="list-group-item list-group-item-action">
	  	<i class="icon-wallet"></i> &nbsp;
	  	Dompet Untuknegeri
	  </a>
	  <a href="{{ route('profile-account') }}" class="list-group-item list-group-item-action">
	  	<i class="icon-settings"></i> &nbsp;
	  	Akun
	  </a>
	</div>
</div>