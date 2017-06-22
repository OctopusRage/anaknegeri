@foreach($withdraw as $withdraw)

<h4>
	<a href="/">{{$withdraw->report->title}}</a>
</h4>
<p>
	<small>
		<i class="icon-user"></i>&nbsp;
		{{ $withdraw->campaign->user->name }}
		&nbsp;
		<i class="icon-calendar"></i>&nbsp;
		<?php echo date('D, d M Y', strtotime($withdraw->report->created_at)); ?>
	</small>
</p>
<p>
	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam sed est exercitationem earum aspernatur. Ipsa at quisquam ratione rerum, eveniet, nihil, id expedita deleniti voluptatum minus sunt, corporis itaque iste!
	<a href="" class="text-primary">Selengkapnya...</a>
</p>
@endforeach