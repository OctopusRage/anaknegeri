<ul class="nav nav-tabs nav-justified" role="tablist" style="margin-top: -38px;">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home4" role="tab" aria-controls="home"><i class="icon-info"></i> Detail </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile"><i class="icon-note"></i> Pelaporan &nbsp;<span class="badge badge-pill badge-success">29</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#messages4" role="tab" aria-controls="messages"><i class="icon-bubbles"></i> Komentar &nbsp;<span class="badge badge-pill badge-info">29</span></a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="home4" role="tabpanel">
        <!-- Detail Campaign -->        
        {{ $campaign->detail }}
    </div>
    <div class="tab-pane" id="profile4" role="tabpanel">
       <?php for ($i=0; $i <10 ; $i++) {
        ?>
            @include('components.laporan')
       <?php } ?>
    </div>
    <div class="tab-pane" id="messages4" role="tabpanel">

        <?php for ($i=0; $i <10 ; $i++) {
        ?>
            <div class="media mb-3">
              <img class="d-flex mr-3 rounded-circle" src="{{ asset('img/avatars/6.jpg') }}" alt="Generic placeholder image">
              <div class="media-body">
                <p class="h6 text-bold mt-2">
                  Pandhu Weni
                <br>
                </p>
                <p><small><i class="icon-calendar"></i> &nbsp; 25 Januari 2018</small></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias perferendis eaque obcaecati nemo adipisci quae eveniet, molestias ex quis nisi, officiis reiciendis quas voluptatibus, ut voluptates hic autem architecto. Cum.</p>
              </div>
            </div>
            <hr>
       <?php } ?>
     

    </div>
</div>
