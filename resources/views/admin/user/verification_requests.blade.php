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
  <!-- <script type="text/javascript">
    $(document).ready(function(){

      $('#infoUser').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
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
  <script type="text/javascript">
    $(document).ready(function(){
      $('#addUser').on('show.bs.modal', function (event) {
        $('#detailAction').load('/admin/user/add-modal');
        $('#btnAdd').click(function(){
          $('#btnAdd').hide();
          var request = {
            'name': $('#inputFullName').val(),
            'email': $('#inputEmail').val(),
            'password': $('#inputPassword').val(),
            'role[]' : [],
            'activated' : $('#inputActivated:checked').val(),
            'verified' : $('#inputVerified:checked').val(),
          };
          $(".role:checked").each(function() {
            request['role[]'].push($(this).val());
          });
          console.log(request);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax(
          {
            url: '{{ route("admin.addUser")}}',
            data: request,
            type: "POST",
            beforeSend: function()
            {
              $('#detailAction').html('<h5 class="text-center"><i class="fa fa-spinner fa-pulse"></i>&nbsp; Mohon Menunggu...</h5>');
            }
          })
          .done(function(data)
          {
            console.log(data);
            $("#detailAction").html('<h5 class="text-center text-success"><span class="icon-check mb-3"></span><br> User berhasil ditambahkan </h5>');
            $('#verifications-table').DataTable().ajax.reload();
          })
          .fail(function(ajaxOptions, thrownError)
          {
           console.log(thrownError);
           $("#detailAction").html('<h5 class="text-center text-muted"><span class="icon-ghost mb-3"></span><br> Proses Gagal</h5>');
         });
        });
      });   
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#editUser').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        console.log(id);
        $.ajax(
        {
          url: '/admin/user/'+id+'/edit/',
          type: "GET",
          beforeSend: function()
          {
            $('#editAction').html('<h1 class="text-center"><i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...</h1>');
          }
        })
        .done(function(data)
        {
          console.log(data);
          console.log(data);
          $("#editAction").html(data.html);
        })
        .fail(function(ajaxOptions, thrownError)
        {
          console.log(thrownError);
          $("#editAction").html('<h2 class="text-center text-muted"><span class="icon-ghost mb-3"></span><br>Gagal Mengambil Data</h2>');
        });

      });   
    });

  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#editUser').on('show.bs.modal', function (event) {
        $('#btnEdit').show();
        var button = $(event.relatedTarget);
        var id = button.data('id');
        console.log(id);

        $('#btnEdit').click(function(){
          $('#btnEdit').hide();

          var request = {
            'password': $('#inputPassword').val(),
            'role[]' : [],
            'activated' : $('#inputActivated:checked').val(),
            'verified' : $('#inputVerified:checked').val(),
            'status' : $('.status:checked').val(),
          };

          $(".role:checked").each(function() {
            request['role[]'].push($(this).val());
          });
          console.log(request);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax(
          {
            url: '/admin/user/'+id+'/edit',
            data: request,
            type: "POST",
            beforeSend: function()
            {
              $('#editAction').html('<h5 class="text-center"><i class="fa fa-spinner fa-pulse"></i>&nbsp; Mohon Menunggu...</h5>');
            }
          })
          .done(function(data)
          {
            console.log(data);
            $("#editAction").html('<h5 class="text-center text-success"><span class="icon-check mb-3"></span><br> User berhasil diedit </h5>');
            $('#verifications-table').DataTable().ajax.reload();
          })
          .fail(function(ajaxOptions, thrownError)
          {
           console.log(thrownError);
           $("#editAction").html('<h5 class="text-center text-muted"><span class="icon-ghost mb-3"></span><br> Proses Gagal</h5>');

            $('#btnEdit').show();
         });
        });
      });   
    });
  </script> -->
  @endsection