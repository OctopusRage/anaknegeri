<div class="card bg-white pl-4 pr-4 pt-3 pb-5" style="top:-50px !important;"">
    <div class="card-block">

        <h3 class="mb-5 mt-3 text-center">
            Berikan Dukungan
        </h3>
        <form action="{{ route('campaign.donates', [$campaign->slug])}}" method="POST">
        @include('components.status')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group  mb-3">
        
            <label for="support_type">Jenis dukungan yang diberikan</label>
            

             <div class="radio">
                <label for="check_finansial">
                    <input type="radio" id="check_finansial" name="type" value="Finansial">&nbsp; Finansial
                </label>
            </div>
            <div class="radio">
                <label for="check_nonfinansial">
                    <input type="radio" id="check_nonfinansial" name="type" value="Non Finansial">&nbsp; Non Finansial
                </label>
            </div>
        </div>
        <!-- Untuk dukungan finansial -->
        <div class="row">
            <div class="col-md-12 col-sm-12" id="group-input-donasi-finansial">

                <div class="card">
                  <div class="card-block p-0 clearfix">
                      <i class="icon-wallet bg-info p-4 font-2xl mr-3 float-left"></i>
                      <div class="h5 text-info mb-0 pt-3">Rp. {{ Auth::user()->wallet->total }}</div>
                      <div class="text-muted text-uppercase font-weight-bold font-xs">Saldo Dompet</div>
                  </div>
                </div>
                <div class="form-group  mb-3">
                    <label for="name">Jumlah</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rp.
                        </span>
                        <input type="hidden" name="item" value="Dana">
                        <input type="number" class="form-control" name="amount" placeholder="Jumlah Donasi">
                    </div>
                    <span class="help-block">Pesan error</span>
                </div>
            </div>            
        </div>

        <!-- Untuk dukungan nonfinansial -->
        <div class="row" id="group-input-donasi-non-finansial">
            <div class="col-md-12 col-sm-12">
                
                @if($campaign->supportType->count() == 1)
                    @foreach($campaign->supportType as $st)
                      @if($st->pivot->item == "Dana")
                        <h5 class="mt-3 mb-3">Anda bisa menberikan dukungan lain yang mungkin berguna.</h5>
                      @else
                        <h5 class="mt-3">Anda bisa menberikan dukungan pada daftar di bawah ini, atau dukungan lain yang akan berguna.</h5>
                        @foreach($campaign->supportType as $st)
                          @if($st->pivot->item != "Dana")
                            <span class="badge badge-primary pt-2 pb-1 px-3 my-3 mr-3">
                                <h6>
                                    {{ $st->pivot->amount }} {{ $st->pivot->item }}
                                </h6> 
                            </span>
                                                    
                          @endif          
                        @endforeach
                        @endif
                    @endforeach
                @else
                    <h5 class="mt-3">Anda bisa menberikan dukungan pada daftar di bawah ini, atau dukungan lain yang akan berguna.</h5>
                   @foreach($campaign->supportType as $st)
                    
                      @if($st->pivot->item != "Dana")
                        <span class="badge badge-primary pt-2 pb-1 px-3 my-3 mr-3">
                            <h6>
                                {{ $st->pivot->amount }} {{ $st->pivot->item }}
                            </h6> 
                        </span>
                                                
                      @endif          
                    @endforeach
                @endif 
                
                <div class="card">
                    <div class="card-block clearfix">
                        <h6 class="text-justify">Prosedur pemberian dukungan non-finansial</h6>
                        <ol>
                          <li>Daftarkan dukungan pada form di bawah ini</li>
                          <li>Lakukan pengiriman ke alamat di bawah</li>
                          <li>Selanjutnya admin Logistik kami akan memproses dukungan</li>
                        </ol>
                        <div class="img-thumbnail bg-inverse">
                          
                          <p class="h3 text-info text-center mt-4">Jalan Blimbingsari 24, Sleman 33256</p>
                          <p class="h4 text-danger text-center mb-4">a.n. <strong>Pandhu Weni</strong></p>
                        </div>
                    </div>
                </div>
                <div class="form-group  mb-3">
                    <label for="inputItem">Nama barang</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-drawer"></i>
                        </span>
                        <input type="text" class="form-control" name="barang" id="inputItem" placeholder="Nama Barang">
                    </div>
                    <span class="help-block">Pesan error</span>
                </div> 
                <div class="form-group  mb-3">
                    <label for="inputAmount">Jumlah</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-arrow-right"></i>
                        </span>
                        <input type="number" id="inputAmount" name="count" class="form-control" placeholder="Jumlah Donasi">
                    </div>
                    <span class="help-block">Pesan error</span>
                </div>

                <div class="form-group mb-3">
                    <label for="name">Dikirim dari <span class="text-muted"></span></label>
                    <textarea id="inputAddress" name="detail" rows="5" class="form-control" placeholder="Silakan tulis alamat pengiriman anda"></textarea>
                </div>

            </div>
            
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group  mb-3">
                    <div class="checkbox">
                        <label for="inputAnonim">
                            <input type="checkbox" id="inputAnonim" name="anonim" value="1"> Berikan dukungan sebagai anonim?
                        </label>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="inputComment">Komentar <span class="text-muted">Opsional</span></label>
                    <textarea id="inputComment" name="comment" rows="5" class="form-control" placeholder="Berikan dukungan anda!"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Berikan Dukungan!</button>
            </div>
        </div>

        </form>
    </div>
</div>  

@section('viewjs')
<script type="text/javascript">
    $(document).ready(function(){

        $('#group-input-donasi-finansial').hide();
        $('#group-input-donasi-non-finansial').hide();


        $("input[name=type]").change(function() {
            var type = $(this).val();
            if(type=="Finansial"){
                $("#group-input-donasi-finansial").slideDown();
                $('#group-input-donasi-non-finansial').hide();
            }else if(type=="Non Finansial"){

                $("#group-input-donasi-non-finansial").slideDown();            
                $('#group-input-donasi-finansial').hide();
            }
        });

        // if($('#check_finansial').prop('checked', true)){
        //     $("#group-input-donasi-finansial").slideDown();
        //     $('#group-input-donasi-non-finansial').hide();
        // }else if($('#check_nonfinansial').prop('checked', true)){
        //     $("#group-input-donasi-non-finansial").slideDown();            
        //     $('#group-input-donasi-finansial').hide();
        // }else{
        //     $('#group-input-donasi-non-finansial').hide();
        // }


    });

    $(document).ready(function(){
        var anonim = $('#inputAnonim');
        anonim.val(0);
        if($(anonim).is(':checked')){
            $(this).val(1);
        }else{
            $(this).val(0);
        }
    });
</script>
@endsection