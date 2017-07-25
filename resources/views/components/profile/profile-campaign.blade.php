<div class="row">
  <div class="col-md-12">
    <div class="card">

        <div class="card-header">
          <h3 class="text-center">Campaign Anda</h3>
        </div>
        <div class="card-block p-3 clearfix " >
          <a href="{{ route('campaign.create')}}" class="btn btn-sm btn-secondary">
            <span class="icon-plus"></span>
              Buat Campaign Baru
          </a>
        </div>
        <div class="card-block p-3 clearfix " >
            <div class="row">
              <div class="col" id="campaign-data">
                
                @include('components.profile.campaign-on-profile')
              </div>
            </div>              
          <p class="text-center">
            @if($campaigns->count()>0)
              <button class="btn btn-primary" id="loadMore">Muat Selanjutnya...</button>
            @else
              <h2 class="text-center">                
                <span class="icon-ghost text-muted"></span>
              </h2>
              <h5 class="text-muted text-center">
               Tidak Ada data...
              </h5>
            @endif
          </p>
        </div>
         
    </div>
  </div>
 
</div>
 @section('pluginjs')
<script type="text/javascript">
    var page = 1;

    $('#loadMore').click(function(){
      page++;
      loadMoreData(page);
      console.log(page);
    });

    function loadMoreData(page){
      $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                beforeSend: function()
                {
                    $('#loadMore').html('<i class="fa fa-spinner fa-pulse"></i>&nbsp; Memuat...');
                }
            })
            .done(function(data)
            {
              console.log(data);
                if(data.html == ""){

                    $('#loadMore').attr("disabled", "disabled");
                    $('#loadMore').html('Semua data telah dimuat...');
                    return;
                }
                $('#loadMore').html('Muat Selanjutnya...');
                $("#campaign-data").append(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                 $("#loadMore").html('Gagal Memuat Data...');
            });
    }

    
</script>
@endsection