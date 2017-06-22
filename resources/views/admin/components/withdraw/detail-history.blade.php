<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-striped">
			<thead class="thead-inverse">
				<tr>
					<th>ID Penarikan</th>
					<th>{{ $withdraw->id }}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Judul Campaign</td>
					<td>{{ $withdraw->campaign->title }}</td>
				</tr>
				<tr>
					<td>Item</td>
					<td>{{ $withdraw->item }}</td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td>{{ $withdraw->amount }}</td>
				</tr>
				<tr>
					<td>@if($withdraw->item == "Dana") Rekening @else Alamat @endif</td>
					<td>{{ $withdraw->detail }}</td>
				</tr>
				<tr>
					<td>Diajukan Oleh</td>
					<td>{{ $withdraw->campaign->user->name }}</td>
				</tr>
				<tr>
					<td>Diajukan Pada</td>
					<td><?php echo date('d M Y H:i:s', strtotime($withdraw->created_at)) ?></td>
				</tr>
				<tr>
					<td>Dikonfirmasi pada</td>
					<td><?php echo date('d M Y H:i:s', strtotime($withdraw->updated_at)) ?></td>
				</tr>
				<tr>
					<td>Status</td>
					<td>{{ $withdraw->getStatus() }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>