<div class="jumbotron jumbotron-fluid mb-0 bg-white">
  <div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12">
      
      <h1 class="display-5 mb-3">Beasiswa untuk NTT</h1>
    </div>
    <div class="col-md-9 col-sm-12">
      <p class="lead">{{ $campaign->subtitle }}</p>

    </div>
    <div class="col-md-3 col-sm-12">
      <h3 class="mb-3">Membutuhkan</h3>

      <table class="table table-sm table-bordered" >
          <tbody>
               @foreach($campaign->supportType as $st)
              <tr>
                  <td class="bg-inverse">{{ $st->pivot->item }}</td>
                  <td>@if($st->pivot->item == "Dana") Rp. @endif {{ $st->pivot->amount }}</td>
              </tr>            
              @endforeach
          </tbody>
      </table>
      <div class="progress">
        <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <h6 class="mt-3">
        <i class="icon-calendar"></i>&nbsp; Deadline 
          <span class="text-bold text-danger"><?php echo date('d M Y', strtotime($campaign->deadline)); ?></span>
        </h6>
    </p>
    </div>
  </div>
    
  </div>
</div>