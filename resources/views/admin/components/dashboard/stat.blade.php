<div class="row">
	<div class="col">
      <div class="card">
          <div class="card-block p-0 clearfix">
              <i class="icon-people bg-info p-4 font-2xl mr-3 float-left"></i>
              <div class="h5 text-info mb-0 pt-3">{{ $user->count() }}</div>
              <div class="text-muted text-uppercase font-weight-bold font-xs">User</div>
          </div>
      </div>
  </div>
  <div class="col">
      <div class="card">
          <div class="card-block p-0 clearfix">
              <i class="icon-cursor bg-warning p-4 font-2xl mr-3 float-left"></i>
              <div class="h5 text-warning mb-0 pt-3">{{ $campaign->count() }}</div>
              <div class="text-muted text-uppercase font-weight-bold font-xs">Campaign</div>
          </div>
      </div>
  </div>
  <div class="col">
      <div class="card">
          <div class="card-block p-0 clearfix">
              <i class="icon-docs bg-danger p-4 font-2xl mr-3 float-left"></i>
              <div class="h5 text-danger mb-0 pt-3">{{ $report->count() }}</div>
              <div class="text-muted text-uppercase font-weight-bold font-xs">Pelaporan</div>
          </div>
      </div>
  </div>
  <div class="col">
      <div class="card">
          <div class="card-block p-0 clearfix">
              <i class="icon-emotsmile bg-success p-4 font-2xl mr-3 float-left"></i>
              <div class="h5 text-success mb-0 pt-3"><?php $i=0; ?>@foreach ($campaign as $camp) @if($camp->isSuccess()) {{ $i++ }} @endif @endforeach<?php echo $i; ?></div>
              <div class="text-muted text-uppercase font-weight-bold font-xs">Campaign Suskses</div>
          </div>
      </div>
  </div>
</div>