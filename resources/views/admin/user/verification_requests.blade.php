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
       <h4 class="float-left">Verifikasi Pengguna</h4>
    </div>
  </div>    	
  <table class="table table-striped table-bordered" id="verifications-table" style="width: 100% !important">
    <thead class="thead-inverse">
     <tr >
      <th>ID</th>
      <th>Name</th>
      <th>Confirmed</th>
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

    $('#verifications-table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        'url': '{{ route("admin.getUsersVerification") }}',
        'type': 'GET',
        'headers': {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      "columns": [
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'confirmed', name: 'confirmed' },
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
      $('#confirmUser').on('show.bs.modal', function (event) {
        $('#confirmUser').show();
        var button = $(event.relatedTarget);
        var id = button.data('id');
        console.log(id);

        $('#btnConfirmUser').click(function(){
          $('#btnConfirmUser').hide();
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
          });
          $.ajax(
          {
            url: '/admin/verification/'+ id +'/confirm',
            data: {},
            type: "POST",
            beforeSend: function()
            {
              $('#confirmContent').html('<h5 class="text-center"><i class="fa fa-spinner fa-pulse"></i>&nbsp; Mohon Menunggu...</h5>');
            }
          })
          .done(function(data)
          {
            console.log(data);
            $("#confirmContent").html('<h5 class="text-center text-success"><span class="icon-check mb-3"></span><br> User berhasil dikonfirmasi </h5>');
            $('#verifications-table').DataTable().ajax.reload();
          })
          .fail(function(ajaxOptions, thrownError)
          {
           console.log(thrownError);
           $("#confirmContent").html('<h5 class="text-center text-muted"><span class="icon-ghost mb-3"></span><br> Proses Gagal</h5>');

            $('#btnEdit').show();
         });
        });
      });   
    });
  </script>
  @endsection