<ul class="nav nav-tabs nav-justified" role="tablist" style="margin-top: -38px;">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#detail" role="tab" aria-controls="home"><i class="icon-info"></i> Detail </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#report" role="tab" aria-controls="profile"><i class="icon-note"></i> Pelaporan &nbsp;<span class="badge badge-pill badge-success">{{$withdraw->count()}}</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#comment" role="tab" aria-controls="messages"><i class="icon-bubbles"></i> Komentar &nbsp;<span class="badge badge-pill badge-warning">{{$campaign->support->where("comment","!=", null)->count() }}</span></a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane p-5 active" id="detail" role="tabpanel">
        <!-- Detail Campaign -->        
        {!! $campaign->detail !!}
    </div>
    <div class="tab-pane p-5" id="report" role="tabpanel">
        <div id="report-data">
            @include('components.laporan')
        </div>
       <button type="button" id="loadMoreReport" class="btn btn-secondary">Muat Selanjutnya...</button>
    </div>
    <div class="tab-pane p-5" id="comment" role="tabpanel">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <span class="icon-hourglass"></span>&nbsp; Status Terkini Donasi
                    </div>
                    <div class="card-block">
                        <div class="card">
                          <div class="card-block p-0 clearfix">
                              <i class="icon-cursor bg-info p-4 font-2xl mr-3 float-left"></i>
                              <div class="h5 text-info mb-0 pt-3">
                                  Rp. {{ $campaign->getStatusFinansial() }}
                              </div>
                              <div class="text-muted text-uppercase font-weight-bold font-xs">Dana Terkumpul</div>
                          </div>
                      </div>
                      <h5 class="mb-3">Dukungan Lainnya</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Dukungan</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($campaign->support as $supports)
                                    @if($supports->item != "Dana")
                                        @if($supports->count() == 0)
                                            <tr>
                                                <td colspan="2" class="text-center">                                                  
                                                    Belum ada dukungan lain
                                                </td>
                                            </tr>
                                        @else
                                        <tr>
                                            <td>
                                                {{$supports->item}}
                                            </td>
                                            <td>
                                                {{$supports->amount}}
                                            </td>
                                        </tr> 
                                        @endif
                                    @endif
                                @endforeach

                            </tbody>
                        </table>    
                        @if($campaign->support->count() !=0)
                        <h5 class="mb-3">Dukungan Terakhir</h5>

                        <p>{{ $campaign->support->last()->getName() }} pada 
                        <?php echo date('d M Y', strtotime($campaign->support->last()->created_at)); ?></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8" >
                <h4 class="mb-3">
                    Komentar Donatur
                </h4>
                <div id="comment-data">
                    
                </div>
                <button type="button" id="loadMore" class="btn btn-secondary mt-3">Muat Selanjutnya...</button>
            </div>
        </div>
     

    </div>
</div>
@section('viewjs')
<script type="text/javascript">
var page = 1;
$(document).ready(function(){
    loadMoreData(page);
});

$('#loadMore').click(function(){
    page++;
    loadMoreData(page);
    console.log(page);
});

function loadMoreData(page){
  $.ajax(
        {
            url: '{{url("/")}}/campaign/detail/'+'{{ $campaign->slug }}'+'/comment?page=' + page,
            type: "GET",
            beforeSend: function()
            {
                $('#loadMore').html('<i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...');
            }
        })
        .done(function(data)
        {
            console.log(data);
            if(data.html == ""){
                $('#loadMore').html('Semua data telah dimuat...');
                $('#loadMore').attr("disabled", "disabled");
                $('#loadMore').addClass("btn-secondary");
                return;
            }
            $('#loadMore').html('Muat Selanjutnya...');
            $("#comment-data").append(data.html);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('Server tidak merespon...');
        });
}

</script>
<script type="text/javascript">
// var page = 1;
// $(document).ready(function(){
//     loadMoreData(page);
// });

// $('#loadMoreReport').click(function(){
//     page++;
//     loadMoreData(page);
//     console.log(page);
// });

// function loadMoreData(page){
//   $.ajax(
//         {
//             url: '{{url("/")}}/campaign/detail/'+'{{ $campaign->slug }}'+'/comment?page=' + page,
//             type: "GET",
//             beforeSend: function()
//             {
//                 $('#loadMore').html('<i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...');
//             }
//         })
//         .done(function(data)
//         {
//             console.log(data);
//             if(data.html == ""){
//                 $('#loadMore').html('Semua data telah dimuat...');
//                 $('#loadMore').attr("disabled", "disabled");
//                 $('#loadMore').addClass("btn-secondary");
//                 return;
//             }
//             $('#loadMore').html('Muat Selanjutnya...');
//             $("#comment-data").append(data.html);
//         })
//         .fail(function(jqXHR, ajaxOptions, thrownError)
//         {
//               alert('Server tidak merespon...');
//         });
// }

</script>
@endsection