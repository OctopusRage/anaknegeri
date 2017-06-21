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
	<a href="{{ route('profile.withdraw',[$campaign->id])}}" class="btn btn-sm btn-secondary">
		<span class="icon-drawer"></span>
		Permintaan Penarikan
	</a>
	<a href="{{ route('profile.report',[$campaign->id])}}" class="btn btn-sm btn-success">
		<span class="icon-docs"></span>
		Laporan
	</a>
	<a href="{{ route('campaign.detail',[$campaign->slug])}}" class="btn btn-sm  btn-primary">
	<span class="icon-book-open"></span>
		Baca Selengkapnya 
	</a>
</p>
<hr>
@endforeach