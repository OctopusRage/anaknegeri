@foreach($campaigns as $campaign)
<h4>
	<a href="{{ route('campaign.detail',[$campaign->slug])}}">{{ $campaign->title }}
	</a>
</h4>
<p>
	<small>
		<i class="icon-user"></i>&nbsp;
			{{ $campaign->user->name }}
		<i class="icon-calendar pl-3"></i>&nbsp;
			<?php echo date('D, d M Y', strtotime($campaign->deadline)); ?>
		<strong>
			<i class="icon-chart pl-3"></i>&nbsp;
			{{ $campaign->getProgress() }} % terdanai	
		</strong>
		
		
	</small>
</p>
<p>
	{{$campaign->subtitle}}
</p>
<p>
	<a href="{{ route('campaign.detail',[$campaign->slug])}}" class="btn btn-sm btn-success">
		Rincian
	</a>
	<a href="{{ route('campaign.detail',[$campaign->slug])}}" class="btn btn-sm  btn-secondary">
		Baca Selengkapnya 
	</a>
</p>
<hr>
@endforeach