@section('plugincss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css')}}">
@endsection
<div class="card bg-white mt-5">
    <div class="card-block">

        <h3 class="mb-5 mt-3 text-center">
            Buat Campaign<br>
            <small class="text-muted">Berikan sumbangsih untuk pendidikan Indonesia</small>
        </h3>
        <!-- Untuk dukungan finansial -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                {!! Form::open(['url' => url('campaign/create'), 'method'=>'post']) !!}

                @include('components.status')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <div class="form-group  mb-3">
                   <label for="inputCategory">Kategori</label>
                   <div class="input-group">
                        <span class="input-group-addon"><i class="icon-list"></i></span>                        
                       <select name="category_id" class="form-control">
                           <option selected disabled>Pilih Kategori</option>
                           @foreach ($category as $cat)
                            <option value="{{$cat->id}}">{{ $cat->category }}</option>
                           @endforeach
                       </select>
                    </div>                    
                    <span class="help-block">Pesan error</span>
                </div>
                <div class="form-group  mb-3">
                    <label for="inputTitle">Judul Campaign</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-note"></i></span>
                        {!! Form::text('title', null, [
                            'class'                         => 'form-control',
                            'placeholder'                   => 'Judul Campaign',
                            'required',
                            'id'                            => 'inputTitle'
                        ]) !!}
                    </div>
                    <span class="help-block">Pesan error</span>
                </div>
                <div class="form-group  mb-3">
                    <label for="inputSubtitle">Subjudul Campaign</label>
                    {!! Form::textarea('subtitle', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Subjudul Campaign',
                        'required',
                        'id'                            => 'inputSubjudul',
                        'rows'                          => 5
                    ]) !!}
                    <span class="help-block">Pesan error</span>
                </div>

                <div class="form-group  mb-3">
                    <label for="inputFeatureImg">Feature Image</label>                    
                    <div class="input-group">
                    {!! Form::file('feature_img', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Browse File',
                        'required',
                        'id'                            => 'inputFeatureImg'
                    ]) !!}
                    </div>
                    <span class="help-block">Pesan error</span>
                </div>
                <div class="form-group  mb-3">
                    <label for="inputDeadline">Deadline Campaign</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        {!! Form::text('deadline', null, [
                            'class'                         => 'form-control',
                            'placeholder'                   => 'DD/MM/YYYY',
                            'required',
                            'id'                            => 'inputDeadline'
                        ]) !!}
                    </div>
                    <span class="help-block">Pesan error</span>
                </div>                
                <div class="form-group  mb-3">
                    <label for="inputSlug">Slug</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-link"></i></span>
                        {!! Form::text('slug', null, [
                            'class'                         => 'form-control',
                            'placeholder'                   => 'Alamat Unik Campaign',
                            'required',
                            'id'                            => 'inputSlug'
                        ]) !!}
                    </div>
                    <span class="help-block">Pesan error</span>
                </div>
                 <div class="form-group  mb-3">
                    <label for="inputAddress">Alamat Campaign</label>
                    {!! Form::textarea('address', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Alamat Campaign',
                        'required',
                        'id'                            => 'inputAddress',
                        'rows'                          => 5
                    ]) !!}
                    <span class="help-block">Pesan error</span>
                </div>
                <div class="form-group  mb-3">

                    <label for="support_type">Jenis dukungan yang dibutuhkan</label>
                    <div class="checkbox">
                        <label for="check_finansial">
                            <input type="checkbox" name="check_finansial" value="finansial" id="check_finansial">
                            Finansial
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="check_nonfinansial">
                            <input type="checkbox" name="check_nonfinansial" value="non finansial" id="check_nonfinansial">
                            Non Finansial
                        </label>
                    </div>
                </div>

                <div class="form-group mb-3" id="group-input-donasi-finansial">
                    <label for="inputDonasiFinansial">Jumlah Donasi Dibutuhkan</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        {!! Form::number('donasi_finansial', null, [
                            'class'                         => 'form-control',
                            'placeholder'                   => 'Jumlah Donasi',
                            'id'                            => 'inputDonasiFinansial'
                        ]) !!}
                    </div>
                    <span class="help-block">Pesan error</span>
                </div>

                <div class="form-group  mb-3" id="group-input-donasi-non-finansial">
                    <label for="inputDonasiFinansial">Item Lain yang Dibutuhkan</label>
                    <table class="table table-bordered" id="tableNonFinansial">
                        <thead class="thead-inverse">
                            <tr>
                                <td>Item</td>
                                <td>Jumlah</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="item[]" class="form-control">
                                </td>
                                <td>
                                    <input type="number" name="amount[]" class="form-control">
                                </td>
                                <td>                                    
                                    <button class="btn btn-sm btn-danger removeRow" type="button">
                                        <span class="icon-minus"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>                    
                    <button class="btn btn-primary" id="addRow" type="button">
                        <span class="icon-plus"></span>&nbsp; Tambah
                    </button>
                    <br>
                    <span class="help-block">Pesan error</span>
                </div>

                <div class="form-group  mb-3">
                    <label for="inputDetail">Detail Campaign</label>
                    {!! Form::textarea('detail', null, [
                        'class'                         => 'form-control',
                        'placeholder'                   => 'Tuliskan detail tentang campaign disini',
                        'id'                            => 'inputDetail'

                    ]) !!}
                    <span class="help-block">Pesan error</span>
                </div>

                <button type="submit" class="btn btn-lg btn-success">Buat Campaign!</button>
                
                {!! Form::close() !!}
            </div>
            
        </div>
    </div>
</div>  
@section('pluginjs')
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('tinymce/jquery.tinymce.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('tinymce/tinymce.min.js')}}"></script>
@endsection
@section('viewjs')
<script type="text/javascript">
    //Datepicker for deadline
    $('#inputDeadline').datepicker({
        format: 'DD, dd MM yyyy',
        autoclose: true,
        startDate: '+1d',
        clearBtn:true,
        maxViewMode:2
    });
</script>
<script type="text/javascript">
    // Switch Display for Donasi

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
    // Toggle Show Support Type
    $(document).ready(function(){
        $('#group-input-donasi-finansial').hide();
        $('#group-input-donasi-non-finansial').hide();
        $('#check_finansial').click(function(){
            $("#group-input-donasi-finansial").toggle();
        });
        $('#check_nonfinansial').click(function(){
            $('#group-input-donasi-non-finansial').toggle();
        });
    })
</script>
<script type="text/javascript">
    // Add and Remove Table row for Input support nonfinansial
    var templateTable=' <tr><td><input type="text" name="item[]" class="form-control"></td><td><input type="number" name="amount[]" class="form-control"></td><td><button class="btn btn-sm btn-danger removeRow" type="button"><span class="icon-minus"></span></button></td></tr>';
    $('#addRow').click(function(){
        $('#tableNonFinansial tr:last').after(templateTable);

        $('.removeRow').click(function(){
            $(this).parents('tr').first().remove();
        });
    });
</script>
<script type="text/javascript">
    $(document).on('nested:fieldRemoved', function (event) {
        $('[required]', event.field).removeAttr('required');
      });
</script>
@endsection