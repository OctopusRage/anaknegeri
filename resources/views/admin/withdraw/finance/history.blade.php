@extends('admin.layouts.app')
@section('title','Riwayat Konfimasi Penarikan Dana')
@section('plugincss')
	<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('content')
	<div class="row">
		<div class="col">
	    <div class="card">
	    	<div class="card-block">	
	    		<div class="row">
	    			<div class="col-md-12 mb-4 ">
	    				<h4 class="float-left">Riwayat Konfimasi Penarikan Dana</h4>
	    				
	    			</div>
	    		</div>    	
						<table class="table table-striped table-bordered" id="history-table" style="width: 100% !important">
						<thead class="thead-inverse">
							<tr >
								<th>ID</th>
								<th>Judul Campaign</th>
                <th>Item</th>
                <th>Jumlah</th>
                <th>Tanggal Konfirmasi</th>
                <th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
	    	</div>
			</div>
		</div>
	</div>
  @include('admin.components.withdraw.modal')
@endsection
@section('pluginjs')
	<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
@endsection
@section('viewjs')

	<script type="text/javascript">
		//Handling Datatbles
    
    $('#history-table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        'url': '{{ route("admin.getFinanceWithdrawHistory") }}',
        'type': 'GET',
        'headers': {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      "columns": [
          { data: 'id', name: 'id' },
          { data: 'campaign_title', name: 'campaign_title' },
          { data: 'item', name: 'item' },
          { data: 'amount', name: 'amount' },
          { data: 'updated_at', name: 'updated_at' },
          { data: 'status', name: 'status' },
          { data: 'action', name: 'action', orderable: false, searchable: false}
      ],
      "language": {
          "decimal":        "",
          "emptyTable":     "Tidak ada data",
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
  $(document).ready(function(){

  $('#infoWithdraw').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    console.log(id);
      
    $.ajax(
      {
          url: '{{ route("admin.index")}}/withdraw/finance/history/'+id+'/show/',
          type: "GET",
          beforeSend: function()
          {
              $('#detailWithdraw').html('<h1 class="text-center"><i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...</h1>');
          }
      })
      .done(function(data)
      {
        console.log(data);
          console.log(data);
          $("#detailWithdraw").html(data.html);
      })
      .fail(function(ajaxOptions, thrownError)
      {
        // console.log(jqXHR.status);
       console.log(thrownError);
          $("#detailWithdraw").html('<h2 class="text-center text-muted"><span class="icon-ghost mb-3"></span><br>Gagal Mengambil Data</h2>');
      });



     
  });   
  });
  
  </script>
@endsection