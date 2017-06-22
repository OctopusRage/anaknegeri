@section('plugincss')
  <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endsection
<div class="row">
  
  <div class="col-md-12">
    <div class="card">
        
      <div class="card-header">
        <h3 class="text-center">Data Penarikan</h3>
      </div>
      <div class="card-block p-3 clearfix">
        <div class="row">
          <div class="col-md-8">
            <dl class="row">
              <dt class="col-sm-3">Judul</dt>
              <dd class="col-sm-9">{{ $campaign->title }}</dd>
              <dt class="col-sm-3">Deadline</dt>
              <dd class="col-sm-9"><?php echo date('D, d M Y', strtotime($campaign->deadline)); ?></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <button type="button" id="show-add-withdraw" class="btn btn-secondary btn-block btn-lg mb-3">
              <span class="icon-drawer">
                
              </span>
              Permintaan penarikan
            </button>
          </div>
        </div>
          
        @include('components.status')
        
        <div class="card pt-3" id="form-add-withdraw">
          <h3 class="text-center texr-info"> Permintaan Penarikan</h3>
          <div class="card-block ">
  
          <form action="{{ route('profile.postWithdraw', [$campaign->id])}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group  mb-3">
        
              <label for="support_type">Jenis Penarikan</label>
               <div class="radio">
                <label for="check_finansial">
                  <input type="radio" id="check_finansial" name="type" value="Finansial">&nbsp; Finansial
                </label>
              </div>
              <div class="radio">
                <label for="check_nonfinansial">
                  <input type="radio" id="check_nonfinansial" name="type" value="Non Finansial">&nbsp; Non Finansial
                </label>
              </div>
            </div>
              <div id="group-finansial">
    
                 <div class="card">
                  <div class="card-block p-0 clearfix">
                      <i class="icon-wallet bg-success p-4 font-2xl mr-3 float-left"></i>
                      <div class="h5 text-success mb-0 pt-3">Rp. {{ $campaign->getAvailableForWithdraw() }}</div>
                      <div class="text-muted text-uppercase font-weight-bold font-xs">Dana Tersedia</div>
                  </div>
                </div>
                <div class="form-group {{ $errors->has('amount') ? ' has-danger' : '' }}  mb-3">
                  <label for="inputAmount">Jumlah Penarikan</label>
                  <div class="input-group">
                    <span class="input-group-addon">Rp. </span>
                    <input type="number" class="form-control" name="amount_bank" id="inputAmount">
                  </div>
                </div>

                <div class="form-group {{ $errors->has('amount') ? ' has-danger' : '' }}  mb-3">
                  <label for="inputRekening">Rekening bank</label>
                  <textarea class="form-control" name="bank_detail" rows="5" placeholder="Masukkan Detail Nomor Rekening Bank (Nomor Rekening - Atas Nama - BANK)" id="inputRekening"></textarea>
                </div>
              </div>

              <div id="group-non-finansial">
                <h5>Dukungan Non Finansial yang tersedia</h5>
                 @foreach($campaign->supportType as $st)
                    @if($st->pivot->item != "Dana")
                      <span class="badge badge-primary pt-2 pb-1 px-3 my-3 mr-3">
                          <h6>
                              {{ $st->pivot->amount }} {{ $st->pivot->item }}
                          </h6> 
                      </span>               
                    @endif          
                  @endforeach
                <div class="form-group {{ $errors->has('item') ? ' has-danger' : '' }}  mb-3">
                  <label for="inputAmount">Masukkan Item</label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="icon-note"></span></span>
                    <input type="text" class="form-control" name="item" id="inputAmount">
                  </div>
                </div>
                <div class="form-group {{ $errors->has('detail') ? ' has-danger' : '' }}  mb-3">
                  <label for="inputAmount">Jumlah Penarikan</label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="icon-layers"></span></span>
                    <input type="number" class="form-control" name="amount" id="inputAmount">
                  </div>
                </div>

                <div class="form-group {{ $errors->has('detail') ? ' has-danger' : '' }}  mb-3">
                  <label for="inputAmount">Alamat Pengiriman</label>
                  <textarea class="form-control" name="detail" rows="5" placeholder="Kemana barang ini akan dikirim?"></textarea>
                </div>
              </div>
           <button type="submit" class="btn btn-primary">Permintaan Penarikan</button>
          </form>

          </div>
        </div>

      </div>

 
      <div class="card-block clearfix">
        <table class="table table-striped table-bordered" id="withdraw-table" style="width: 100% !important">
            <thead class="thead-inverse">
              <tr>
                <th>Tanggal</th>
                <th>Penarikan</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
      </div>
         
    </div>
  </div>
 
</div>
@include('components.profile.modal-withdraw')
@section('pluginjs')
  <script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
@endsection
@section('viewjs')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#form-add-withdraw').hide();
      $('#show-add-withdraw').click(function(){
        $('#form-add-withdraw').slideToggle();
      });
    });
  </script>
  <script type="text/javascript">
    $('#group-finansial').hide();
    $('#group-non-finansial').hide();
    $("input[name=type]").change(function() {
      var type = $(this).val();
      if(type=="Finansial"){
        $('#group-non-finansial').hide();
        $('#group-finansial').slideDown();
      }else if(type=="Non Finansial"){
        $('#group-finansial').hide();
        $('#group-non-finansial').slideDown();
      }
    });

  </script>
  <script type="text/javascript">
    //Handling Datatbles
    $('#withdraw-table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        'url': '{{ route("profile.getWithdraws", [$campaign->id])}}',
        'type': 'GET',
        'headers': {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      "columns": [
          { data: 'created_at', name: 'created_at' },
          { data: 'item', name: 'item' },
          { data: 'amount', name: 'amount' },
          { data: 'status', name: 'status'},
          { data: 'action', name: 'action', orderable: false, searchable: false}

      ],
      "language": {
          "decimal":        "",
          "emptyTable":     "Belum ada permintaan penarikan",
          "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          "infoEmpty":      "Tidak ada data",
          "infoFiltered":   "(Disaring dari _MAX_ data)",
          "infoPostFix":    "",
          "thousands":      ",",
          "lengthMenu":     "Tampilkan _MENU_ data",
          "loadingRecords": "Loading...",
          "processing":     "Loading...",
          "search":         "Cari:",
          "zeroRecords":    "Tidak ada data yang sesuai",
          "paginate": {
              "first":      "First",
              "last":       "Last",
              "next":       "Next",
              "previous":   "Previous"
          }
      }
    });
  </script>
  <script type="text/javascript">
    
  $('#infoWithdraw').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id=button.data('id');
      console.log(id);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      $.ajax(
      {
          url: '{{route("profile.home")}}/campaign/{{$campaign->id}}/withdraw/'+id+'/show',
          type: "GET",
          beforeSend: function()
          {
              $('#detailWithdraw').html('<h3 class="text-center text-info"><i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...</h3>');
          }
      })
      .done(function(data)
      {
        console.log(data);
          console.log(data);
          $("#detailWithdraw").html(data.html);
      })
      .fail(function(jqXHR, ajaxOptions, thrownError)
      {
           $("#detailWithdraw").html('<h2 class="text-center text-muted"><span class="icon-ghost mb-3"></span><br>Gagal Mengambil Data</h2>');
      });


     
  });   
  </script>
@endsection