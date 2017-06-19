<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-striped">
			<thead class="thead-inverse">
				<tr>
					<th>ID</th>
					<th>{{ $wallet->id }}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Owner</td>
					<td>{{ $wallet->user->name }}</td>
				</tr>
				<tr>
					<td>Total</td>		
					<td>
						<strong>							
						Rp. {{ $wallet->total }}	
						</strong>
					</td>	
				</tr>
				<tr>
					<td>Last Deposit</td>		
					<td>
						@if ($deposit['created_at'] !=null)
							<?php echo date('D, d M Y', strtotime($deposit['created_at'])); ?>
						@else
							Belum pernah deposit
						@endif
					</td>	
				</tr>
			</tbody>
		</table>
	</div>
</div>