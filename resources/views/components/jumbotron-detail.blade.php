<div class="jumbotron jumbotron-fluid mb-0 bg-white">
  <div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12">
      
    <h1 class="display-5 mb-3 text-capitalize" >{{ $campaign->title }}</h1>
    </div>
    <div class="col-md-9 col-sm-12">

        <div class="media mb-3">
          <img class="d-flex align-self-center mr-3 rounded-circle" style="max-width: 48px; " @if( $campaign->user->profile_img !=null) src="{{ asset('img/avatars/')}}/{{ $campaign->user->profile_img }}" @else src="{{ asset('img/primary.png' )}}" @endif alt="Generic placeholder image" >
          <div class="media-body">

                <p class="h6 text-bold mt-2">
                    <a href="{{route('userprofile.home', $campaign->user->id)}}">
                    {{ $campaign->user->name }} @if ($campaign->user->isVerified(true))
                    </a>
                    <i class="icon-check text-primary"></i>
                    @endif<br>
                  <small class="text-muted text-uppercase">campaigner</small>
                </p>
          </div>
        </div>

        <div class="embed-responsive embed-responsive-16by9 mb-3" width="100%">
          <div class="embed-responsive-item" src="/">  
            <img class="img-thumbnail  border-0 p-0 mb-3"  @if($campaign->feature_img!=null) src="{{ asset('img/campaigns/')}}/{{ $campaign->feature_img }}" @else src="{{ asset('img/bg-primary-lg.png' )}}"  style="backgroud-color:#63c2de !important" @endif alt="{{ $campaign->title }}">
          </div>
        </div>
       
        <p class="lead">{{ $campaign->subtitle }}</p>
    </div>
    <div class="col-md-3 col-sm-12">
      <h3 class="mb-3">Membutuhkan</h3>

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
      <h6 class="mt-3 mb-3">Progress Finansial</h6>
      @include('components.progress')
      <h6 class="mt-3">
        <i class="icon-calendar"></i>&nbsp; Deadline 
          <span class="text-bold text-danger"><?php echo date('d M Y', strtotime($campaign->deadline)); ?></span>
        </h6>
      <hr>
      <a href="{{route('campaign.donate',[$campaign->slug])}}" class="btn btn-primary btn-block btn-lg">Beri dukungan!</a>
      <p class="text-center mt-3">atau</p>
      <hr>
      <h3 class="text-center mt-3 mb-3">Bagikan</h3>
      <p>
        <a class="btn btn-facebook"  href="https://facebook.com/sharer.php?url=<?php echo url()->current(); ?>" style="margin-bottom: 4px"  rel="nofollow" target="_blank" >
            <span>Facebook</span>
        </a>
        <a class="btn btn-twitter" href="https://twitter.com/share?text={{ $campaign->title }}&url=<?php echo url()->current(); ?>&via=pandhuweni" rel="nofollow" target="_blank" style="margin-bottom: 4px">
            <span>Twitter</span>
        </a>
    </p>
    </div>
  </div>
    
  </div>
</div>