@section('plugincss')
  <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endsection

<div class="row">
	<div class="col">
      <div class="card">
          <div class="card-block p-0 clearfix">
              <i class="icon-wallet bg-info p-4 font-2xl mr-3 float-left"></i>
              <div class="h5 text-info mb-0 pt-3">Rp. {{ Auth::user()->wallet->getTotalWallet() }}</div>
              <div class="text-muted text-uppercase font-weight-bold font-xs">Saldo Dompet</div>
          </div>
      </div>
  </div>
  <!--/.col-->

  <div class="col">
      <div class="card">
          <div class="card-block p-0 clearfix">
              <i class="icon-emotsmile bg-warning p-4 font-2xl mr-3 float-left"></i>
              <div class="h5 text-warning mb-0 pt-3">{{ Auth::user()->support->count()}}</div>
              <div class="text-muted text-uppercase font-weight-bold font-xs">Kontribusi</div>
          </div>
      </div>
  </div>
  <!--/.col-->
</div>
<div class="row">
  
  <div class="col-md-12">
    <div class="card">
        
      <div class="card-header">
        <h3 class="text-center">Petunjuk Pengisian</h3>
      </div>
      <div class="card-block p-3 clearfix">
        <h6 class="text-justify">Untuk melakukan pengisian saldo dompet, silakan ikuti langkah di bawah ini:</h6>
        <ol>
          <li>Transfer ke Nomor Rekening di bawah sejumlah nominal yang diinginkan</li>
          <li>Lakukan konfirmasi transfer dengan klik tombol &quot;Konfirmasi Transfer&quot; di bawah  </li>
          <li>Tunggu proses persetujuan admin paling lambat 24 jam terhitung dari waktu konfirmasi</li>
        </ol>
        <div class="img-thumbnail bg-inverse">
          
          <p class="h3 text-info text-center mt-4">6777091269879834 (BRI)</p>
          <p class="h4 text-danger text-center mb-4">a.n. <strong>Pandhu Weni</strong></p>
        </div>

        <p class="text-center">
          <button type="button" id="show-confirmation" class="btn btn-lg btn-success mt-3">Konfirmasi Transfer</button>
        </p>

        @include('components.status')
        
        <div class="card pt-3" id="form-konfirmasi">
          @if(Auth::user()->activated == true)
          <h3 class="text-center texr-info"> Konfirmasi Transfer</h3>
          <div class="card-block ">

          <form action="{{ route('profile.deposit')}}" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group {{ $errors->has('amount') ? ' has-danger' : '' }}  mb-3">
              <label for="inputAmount">Jumlah Transfer</label>
              <div class="input-group">
                <span class="input-group-addon">Rp. </span>
                <input type="number" class="form-control" name="amount" id="inputAmount">
              </div>
                <span class="help-block">
                    @if ($errors->any())
                        {{$errors->first('amount')}}
                    @endif
                </span>
           </div>

            <div class="form-group {{ $errors->has('image') ? ' has-danger' : '' }}  mb-3">
              <label for="inputImage">Bukti Transfer</label>
              <input type="file" class="form-control" name="image" class="inputImage">
                <span class="help-block">
                    @if ($errors->any())
                        {{$errors->first('image')}}
                    @endif
                </span>
           </div>
           <button type="submit" class="btn btn-primary">Konfirmasi</button>
          </form>
          @else
          <div class="card-block alert alert-warning">
                  Akun belum aktif, silakan lakukan aktivasi sesuai prosedur di email. Untuk melakukan topup / konfirmasi transfer harap konfirmasi email anda terlebih dahulu.
          </div>
          @endif
          </div>
        </div>

      </div>
         
    </div>
  </div>
  <div class="col-md-12">
    <div class="card">
        
      <div class="card-header">
        <h3 class="text-center">Daftar Transaksi</h3>
      </div>
      <div class="card-block p-3 clearfix">
        <table class="table table-striped table-bordered" id="deposit-table" style="width: 100% !important">
            <thead class="thead-inverse">
              <tr>
                <th>Tanggal</th>
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
@include('components.profile.modal')
@section('pluginjs')
  <script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
@endsection
@section('viewjs')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#form-konfirmasi').hide();
      $('#show-confirmation').click(function(){
        $('#form-konfirmasi').slideToggle();
      });
    });
  </script>
  <script type="text/javascript">
    //Handling Datatbles
    $('#deposit-table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        'url': '{{ route("profile.getDeposits", [ Auth::user()->id ]) }}',
        'type': 'GET',
        'headers': {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      "columns": [
          { data: 'created_at', name: 'created_at' },
          { data: 'amount', name: 'amount' },
          { data: 'status', name: 'status'},
          { data: 'action', name: 'action', orderable: false, searchable: false}

      ],
      "language": {
          "decimal":        "",
          "emptyTable":     "Belum ada transaksi",
          "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          "infoEmpty":      "Tidak ada transaski",
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
    
  $('#infoDeposit').on('show.bs.modal', function (event) {
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
          url: '{{route("profile.wallet")}}/deposit/'+id,
          type: "GET",
          beforeSend: function()
          {
              $('#detailDeposit').html('<h3 class="text-center text-info"><i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...</h3>');
          }
      })
      .done(function(data)
      {
        console.log(data);
          console.log(data);
          $("#detailDeposit").html(data.html);
      })
      .fail(function(jqXHR, ajaxOptions, thrownError)
      {
           $("#detailDeposit").html('<h2 class="text-center text-muted"><span class="icon-ghost mb-3"></span><br>Gagal Mengambil Data</h2>');
      });


     
  });   
  </script>
@endsection