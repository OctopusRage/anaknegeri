@section('plugincss')
  <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endsection
<div class="row">
  
  <div class="col-md-12">
    <div class="card">
        
      <div class="card-header">
        <h3 class="text-center">Data Laporan</h3>
      </div>

        <div class="card-block clearfix">
            <table class="table table-striped table-bordered" id="report-table" style="width: 100% !important">
                <thead class="thead-inverse">
                <tr>
                    <th>Tanggal</th>
                    <th>Judul</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="card-block clearfix">
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
            <button type="button" id="show-add-report" class="btn btn-secondary btn-block btn-lg mb-3">
              <span class="icon-docs"></span>
              Buat Laporan
            </button>
          </div>
        </div>
          
        @include('components.status')
        
        <div class="card pt-3 hide" id="form-add-report">
          <h3 class="text-center text-info"> Buat Laporan</h3>
          <div class="card-block ">
  
          <form action="{{ route('profile.postReport', [$campaign->id])}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group {{ $errors->has('withdraw_id') ? ' has-danger' : '' }}  mb-3">
                  <label class="form-control-label" for="multiple-select">Laporan Atas</label>
                  <select id="multiple-select" name="withdraw_id" class="form-control" multiple="" style="height: 10rem">

                        @foreach ($withdraws as  $withdraw)
                        <option value="{{ $withdraw->id }}">
                            {{$withdraw->item}} sebanyak
                            @if($withdraw->item=="Dana")
                                Rp.
                            @endif
                            {{$withdraw->amount}}
                            pada
                            <?php echo date('d M Y', strtotime($withdraw->created_at)); ?>
                        </option>
                        @endforeach
                  </select>
                  <span class="help-block">{{$errors->has('withdraw_id')? $errors->first('withdraw_id'): ''}}</span>
              </div>
            <div class="form-group {{ $errors->has('title') ? ' has-danger' : '' }}  mb-3">
              <label for="inputTitle">Judul Laporan</label>
              <div class="input-group">
                <span class="input-group-addon"><icon class="icon-pencil"></icon></span>
                <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Judul Laporan">
              </div>
              <span class="help-block">{{$errors->has('title')? $errors->first('title'): ''}}</span>
            </div>

            <div class="form-group {{ $errors->has('detail') ? ' has-danger' : '' }}  mb-3">
              <label for="inputDetail">Detail</label>
              <textarea class="form-control" name="detail" rows="5" placeholder="Masukkan Detail Laporan atas permintaan penarikan yang dimaksud" id="inputDetail"></textarea>
              <span class="help-block">{{$errors->has('detail')? $errors->first('detail'): ''}}</span>
            </div>
           	<button type="submit" class="btn btn-primary">Buat Laporan</button>
          </form>

          </div>
        </div>

      </div>

 

         
    </div>
  </div>
 
</div>
@include('components.profile.modal-withdraw')
@section('pluginjs')
  <script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('tinymce/jquery.tinymce.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('tinymce/tinymce.min.js')}}"></script>
@endsection
@section('viewjs')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#form-add-report').hide();
      $('#show-add-report').click(function(){
        $('#form-add-report').slideToggle();
      });
    });
  </script>
  <script type="text/javascript">
    //Detail Editor
	    var editor_config = {
	    path_absolute : "/",
	    selector: "#inputDetail",
	    resize: true,
	    plugins: [
	      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	      "searchreplace wordcount visualblocks visualchars code fullscreen",
	      "insertdatetime media nonbreaking save table contextmenu directionality",
	      "emoticons template paste textcolor colorpicker textpattern",
	      "autoresize"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
	    relative_urls: false,
	    file_browser_callback : function(field_name, url, type, win) {
	      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
	      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

	      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
	      if (type == 'image') {
	        cmsURL = cmsURL + "&type=Images";
	      } else {
	        cmsURL = cmsURL + "&type=Files";
	      }

        tinyMCE.activeEditor.getContent({format : 'raw'});

	      tinyMCE.activeEditor.windowManager.open({
	        file : cmsURL,
	        title : 'File Explorer',
	        width : x * 0.8,
	        height : y * 0.8,
	        resizable : "yes",
	        close_previous : "no"
	      });
	    }
	  };
	  tinymce.init(editor_config);

	</script>
  <script type="text/javascript">
    //Handling Datatbles
    $('#report-table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        'url': '{{ route("profile.getReports", [$campaign->id])}}',
        'type': 'GET',
        'headers': {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      "columns": [
          { data: 'created_at', name: 'created_at' },
          { data: 'titlereport', name: 'titlereport' },
          { data: 'action', name: 'action', orderable: false, searchable: false}

      ],
      "language": {
          "decimal":        "",
          "emptyTable":     "Belum ada laporan untuk campaign ini",
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