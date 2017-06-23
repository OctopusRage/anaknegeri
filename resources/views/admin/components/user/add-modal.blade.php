<h5 class="mb-3">Silakan masukkan data utama User</h5>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}  mb-3">
        <label for="inputFullName">Nama Lengkap</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon-user"></i>
          </span>
          <input type="text" name="name" class="form-control" id="inputFullName">
          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  mb-3">

        <label for="inputEmail">Email</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon-envelope"></i></span>
          <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
        </div>
        @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}  mb-3">
          <label for="inputPassword">Passworrd</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="icon-lock"></i>
           </span>
           <input type="password" placeholder="Password" class="form-control" id="inputPassword">
         </div>
         @if ($errors->has('password'))
         <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <div class="col-md-6">
      <h6>Role Admin</h6>
        @foreach($roles as $role)
        <div class="form-group mb-1">
          <div class="checkbox">
              <label for="check_nonfinansial">
                  <input type="checkbox" name="role[]" class="text-capitalize role" value="{{ $role->id }}" >
                  {{ $role->name }}
              </label>
          </div>
        </div>
        @endforeach
      <h6>Status</h6>
        <div class="form-group mb-1">
            <div class="checkbox">
                <label for="inputActivated">
                    <input type="checkbox" name="status[]" class="text-capitalize status" value="1"id="inputActivated" checked disabled>
                    Activated
                </label>  
            </div>
          </div>
          <div class="form-group mb-1">
            <div class="checkbox">
                <label for="inputVerified">
                    <input type="checkbox" name="satus[]" class="text-capitalize status"  value="1" id="inputVerified" checked disabled>
                    Verified
                </label>
            </div>
          </div>
    </div>
  </div>