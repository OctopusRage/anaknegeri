@extends('admin.layouts.app')
@section('title','Manajemen User')
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
	    				<h4 class="float-left">Manajemen User</h4>
	    				<button class="btn btn-secondary float-right" data-toggle="modal" data-target="#addUser">
	    					<i class="icon-user-follow"></i> Tambah
	    				</button>
	    			</div>
	    		</div>    	
						<table class="table table-striped table-bordered" id="user-table" style="width: 100% !important">
						<thead class="thead-inverse">
							<tr >
								<th>ID</th>
								<th>Name</th>
                <th>Email</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
	    	</div>
			</div>
		</div>
	</div>
	@include('admin.components.user.modal')
@endsection
@section('pluginjs')
	<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
@endsection
@section('viewjs')

	<script type="text/javascript">
		//Handling Datatbles
    
    $('#user-table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        'url': '{{ route("admin.getUsers") }}',
        'type': 'GET',
        'headers': {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      "columns": [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
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

  $('#infoUser').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      console.log(id);
      
    $.ajax(
      {
          url: '/admin/user/'+id+'/show/',
          type: "GET",
          beforeSend: function()
          {
              $('#detailUser').html('<h1 class="text-center"><i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...</h1>');
          }
      })
      .done(function(data)
      {
        console.log(data);
          console.log(data);
          $("#detailUser").html(data.html);
      })
      .fail(function(ajaxOptions, thrownError)
      {
        // console.log(jqXHR.status);
       console.log(thrownError);
          $("#detailUser").html('<h2 class="text-center text-muted"><span class="icon-ghost mb-3"></span><br>Gagal Mengambil Data</h2>');
      });



     
  });   
  });
  
  </script>
@endsection