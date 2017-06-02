<div class="row">
	<div class="col">
      <div class="card">
          <div class="card-block p-0 clearfix">
              <i class="icon-cursor bg-info p-4 font-2xl mr-3 float-left"></i>
              <div class="h5 text-info mb-0 pt-3">12</div>
              <div class="text-muted text-uppercase font-weight-bold font-xs">Campaign</div>
          </div>
      </div>
  </div>
  <!--/.col-->

  <div class="col">
      <div class="card">
          <div class="card-block p-0 clearfix">
              <i class="icon-emotsmile bg-success p-4 font-2xl mr-3 float-left"></i>
              <div class="h5 text-success mb-0 pt-3">2</div>
              <div class="text-muted text-uppercase font-weight-bold font-xs">Campaign Sukses</div>
          </div>
      </div>
  </div>
  <!--/.col-->

  <div class="col">
      <div class="card">
          <div class="card-block p-0 clearfix">
              <i class="icon-like bg-warning p-4 font-2xl mr-3 float-left"></i>
              <div class="h5 text-warning mb-0 pt-3">24</div>
              <div class="text-muted text-uppercase font-weight-bold font-xs">Kontribusi</div>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <h3 class="text-center">Update</h3>
        </div>
        <div class="card-block p-3 clearfix">
          <?php for($i=0;$i<5;$i++){ ?>
            @include('components.laporan')
          <?php } ?>
        </div>
         
    </div>
  </div>
 
</div>
