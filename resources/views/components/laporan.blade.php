@foreach($withdraw as $w)

<h4>
	<a href="{{route('campaign.detailReport', ['slug'=> $slug, 'report_id' => $w->report->id])}}">{{$w->report->title}}</a>
</h4>
<p>
	<small>
		<i class="icon-user"></i>&nbsp;
		{{ $w->campaign->user->name }}
		&nbsp;
		<i class="icon-calendar"></i>&nbsp;
		{{date('D, d M Y', strtotime($w->report->created_at))}}
	</small>
</p>
<p>

</p>
@endforeach