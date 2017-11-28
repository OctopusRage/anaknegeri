<?php

    if(isset($userprofile)) {
      $user = $userprofile;
      $profilelink = route('userprofile.home', $user->id);
      $campaignlink = route('userprofile.campaigns', $user->id);
    } else {
        $user = Auth::user();
        $profilelink = route('profile.home', ['id'=>$user->id]);
		$campaignlink = route('profile.campaign');

    }
?>
<div class="card">
	<div class="embed-responsive embed-responsive-1by1">
	  <div class="embed-responsive-item" src="/">  
	  	<img class="card-img-top" @if($user->profile_img !=null) src="{{ asset('img/avatars/')}}/{{ $user->profile_img }}" @else src="{{ asset('img/bg-primary.png' )}}" @endif alt="Card image cap">
		</div>
	</div>
	<div class="card-block">
	  <h4 class="card-title">{{ $user->name }} @if ($user->isVerified(true)) <i class="icon-check text-success"></i> @endif</h4>
	</div>
	<div class="list-group list-group-flush">

	  <a href="{{ $profilelink}}" class="list-group-item  list-group-item-action {{ Request::segment(1) == 'profile' && Request::segment(2)==''? 'active' : null }}">
	  	<i class="icon-user"></i> &nbsp;
	    Profile
	  </a>
	  <a href="{{ $campaignlink }}" class="list-group-item list-group-item-action {{ Request::segment(1) == 'profile' && Request::segment(2)=='campaign'? 'active' : null }}">
	  	<i class="icon-cursor"> </i> &nbsp;
	  	Campaign
	  </a>
	  @if(!isset($userprofile))
	  <a href="{{ route('profile.wallet')}}" class="list-group-item list-group-item-action {{ Request::segment(1) == 'profile' && Request::segment(2)=='wallet'? 'active' : null }}">
	  	<i class="icon-wallet"></i> &nbsp;
	  	Dompet Untuknegeri
	  </a>
	  <a href="{{ route('profile.account') }}" class="list-group-item list-group-item-action">
	  	<i class="icon-settings"></i> &nbsp;
	  	Akun
	  </a>
	  @endif
	</div>
</div>