<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-striped">
			<thead class="thead-inverse">
				<tr>
					<th>ID Report</th>
					<th>{{ $report->id }}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Judul Campaign</td>
					<td>{{ $report->withdraw->campaign->title }}</td>
				</tr>
				<tr>
					<td>Judul Laporan</td>
					<td>{{ $report->title }}</td>
				</tr>
				<tr>
					<td>Dibuat pada</td>
					<td><?php echo date('D, d M Y', strtotime($report->created_at)); ?></td>
				</tr>
				<tr>
					<td>Penggunaan</td>
					<td>{{ $report->withdraw->item }}</td>
				</tr>
				<tr>
					<td>Sebanyak</td>
					<td>@if($report->withdraw->item == "Dana") Rp. @endif {{ $report->withdraw->amount }}</td>
				</tr>
				<tr>
					<td>Dibuat oleh</td>
					<td>{{ $report->withdraw->campaign->user->name }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>