<div class="card bg-white p-3" style="top:-50px !important;"">
    <div class="card-block">
			<h3 class="text-center mb-5">{{$report->title}}</h3>
			<div class="row">
				<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								Detail Penggunaan
							</div>
							<div class="card-block">
								<p>
								<span class="icon-calendar"></span>&nbsp; <?php echo date('d M Y', strtotime($campaign->support->last()->created_at)); ?>
								</p>
								<h6>
									<span class="icon-layers"></span>&nbsp; 
									{{ $report->withdraw->item }} 
									<span class="text-success">
										@if( $report->withdraw->item ) Rp. @endif 
										{{ $report->withdraw->amount }}
									</span>
								</h6>
								<h6>
									<span class="icon-user"></span>&nbsp;
									{{ $report->withdraw->campaign->user->name }}
								</h6>
							</div>
			    </div>
				</div>
				<div class="col-md-8">
					{!! $report->detail !!}
				</div>
			</div>
    </div>
</div>  
