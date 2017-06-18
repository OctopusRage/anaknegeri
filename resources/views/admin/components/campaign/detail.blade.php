

<div class="row">
	<div class="col-md-4">
		<img class="img-thumbnail" @if($campaign->feature_img!=null) src="{{ asset('img/campaigns/thumbs')}}/{{ $campaign->feature_img }}" @else src="{{ asset('img/bg-primary.png' )}}"  style="backgroud-color:#63c2de !important" @endif >
	</div>
	<div class="col-md-8">
		<table class="table table-bordered table-striped">
			<thead class="thead-inverse">
				<tr>
					<th>ID</th>
					<th>{{ $campaign->id }}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Judul</td>
					<td>{{ $campaign->title }}</td>
				</tr>
				<tr>
					<td>Sub Judul</td>
					<td>{{ $campaign->subtitle }}</td>
				</tr>
				<tr>
					<td>Deadline</td>
					<td><?php echo date('D, d M Y', strtotime($campaign->deadline)); ?></td>
				</tr>
				<tr>
					<td>Kebutuhan</td>
					<td>
						@foreach($campaign->supportType as $st)
	            {{ $st->pivot->item }}: 
	            <strong class="text-primary">@if($st->pivot->item == "Dana") Rp. @endif {{ $st->pivot->amount }}</strong>
	            <br>	                       
            @endforeach
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>