@extends('admin.layouts.app')
@section('title','Manajemen Pelaporan')
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
	    				<h4 class="float-left">Manajemen Pelaporan</h4>
	    				
	    			</div>
	    		</div>    	
						<table class="table table-striped table-bordered" id="report-table" style="width: 100% !important">
						<thead class="thead-inverse">
							<tr >
								<th>ID</th>
								<th>Judul Report</th>
                <th>Campaign</th>
                <th>Tanggal</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
	    	</div>
			</div>
		</div>
	</div>
  @include('admin.components.report.modal')
@endsection
@section('pluginjs')
	<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
@endsection
@section('viewjs')

	<script type="text/javascript">
		//Handling Datatbles
    
    $('#report-table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        'url': '{{ route("admin.getAllReports") }}',
        'type': 'GET',
        'headers': {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      "columns": [
          { data: 'id', name: 'id' },
          { data: 'title', name: 'title' },
          { data: 'camp_title', name: 'camp_title' },
          { data: 'created_at', name: 'created_at' },
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

  $('#infoReport').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
      console.log(id);
      
    $.ajax(
      {
          url: '{{ route("admin.index")}}/report/'+id+'/show/',
          type: "GET",
          beforeSend: function()
          {
              $('#detailReport').html('<h1 class="text-center"><i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...</h1>');
          }
      })
      .done(function(data)
      {
        console.log(data);
          console.log(data);
          $("#detailReport").html(data.html);
      })
      .fail(function(ajaxOptions, thrownError)
      {
        // console.log(jqXHR.status);
       console.log(thrownError);
          $("#detailReport").html('<h2 class="text-center text-muted"><span class="icon-ghost mb-3"></span><br>Gagal Mengambil Data</h2>');
      });



     
  });   
  });
  
  </script>
@endsection