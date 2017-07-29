<div class="row">
  <div class="col-md-12">
    <div class="card">

        <div class="card-header">
          <h3 class="text-center">Akun</h3>
        </div>
        <div class="card-block p-3 clearfix">
          @include('components.status')
          @include('components.profile.account-update')
          <hr>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              @include('components.profile.change-password')
            </div>
            <div class="col-md-6 col-sm-12">
              @include('components.profile.account-status')
            </div>
          </div>
          <hr> 
          @include('components.profile.account-verification')
          <hr>
          @include('components.profile.account-disabled')
        </div>         
    </div>
  </div>
 
</div>  
