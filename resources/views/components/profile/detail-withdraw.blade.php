<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-striped">
			<thead class="thead-inverse">
				<tr>
					<th>ID penarikan</th>
					<th>{{ $withdraw->id }}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Campaign</td>
					<td>{{ $campaign->title }}</td>
				</tr>
				<tr>
					<td>Tanggal Permintaan</td>
					<td><?php echo date('D, d M Y', strtotime($withdraw->created_at)); ?></td>
				</tr>
				<tr>
					<td>Item</td>
					<td>{{ $withdraw->item }}</td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td>@if($withdraw->item=="Dana") Rp. @endif {{ $withdraw->amount }}</td>
				</tr>
				<tr>
					<td>@if($withdraw->item=="Dana") Detail Rekening @else Alamat @endif</td>
					<td>{{ $withdraw->detail }}</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>{{ $withdraw->getStatus() }}</td>
				</tr>
				@if($withdraw->addition != null)
				<tr>
					<td>Catatan</td>
					<td>{{$withdraw->addition}}</td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>