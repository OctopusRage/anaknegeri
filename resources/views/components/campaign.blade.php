@foreach($campaigns as $campaign)

<div class="card" >
	<div class="embed-responsive embed-responsive-1by1">
	  <div class="embed-responsive-item" src="/">
        <a href="{{ route('campaign.detail', [$campaign->slug] )}}">
	  	    <img class="card-img-top" @if($campaign->feature_img!=null) src="{{ asset('img/campaigns/thumbs')}}/{{ $campaign->feature_img }}" @else src="{{ asset('img/bg-primary.png' )}}"  style="backgroud-color:#63c2de !important" @endif alt="Card image cap">
        </a>
		</div>
	</div>
    @include('components.progress')
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
            <span class="icon-tag"></span>&nbsp;
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
@endforeach