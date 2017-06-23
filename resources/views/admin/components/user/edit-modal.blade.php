  <div class="row">
    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}  mb-3">
        <label for="inputFullName">Nama Lengkap</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon-user"></i>
          </span>
          <input type="text" name="name" class="form-control" id="inputFullName" value="{{ $user->name }}" disabled>
          @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}  mb-3">
          <label for="inputPassword">Password Baru</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="icon-lock"></i>
           </span>
           <input type="password" placeholder="Password Baru" class="form-control" id="inputPassword">
         </div>
         @if ($errors->has('password'))
         <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <div class="col-md-3">
      <h6>Role</h6>
        @foreach($roles as $role)
        <div class="form-group mb-1">
          <div class="checkbox">
              <label for="check_nonfinansial">
                  <input type="checkbox" name="role[]" class="text-capitalize role" value="{{ $role->id }}" 
                  @if($user->hasRole($role->name))
                    checked
                  @endif
                  >
                  {{ $role->name }}
              </label>
          </div>
        </div>
        @endforeach
    </div>
    <div class="col-md-3">
        <h6>Status</h6>
        <div class="form-group mb-1">
            <div class="checkbox">
                <label for="inputActivated">
                    <input type="checkbox" name="status[]" class="text-capitalize status" value="1"id="inputActivated" 
                    @if($user->isActive(true))
                      checked disabled
                    @endif>
                    Activated
                </label>  
            </div>
          </div>
          @if($user->isActive(true))
          <div class="form-group mb-1" id="group-verified">
            <div class="checkbox">
                <label for="inputVerified">
                    <input type="checkbox" name="satus[]" class="text-capitalize status"  value="1" id="inputVerified"
                    @if($user->isVerified(true))
                      checked disabled
                    @endif>
                    Verified
                </label>
            </div>
          </div>
          @endif
          
          @if($user->isEnable(false))
          <div class="form-group mb-1">
            <div class="checkbox">
                <label for="inputVerified">
                    <input type="checkbox" name="satus[]" class="text-capitalize status" value="1" >
                    Enable
                </label>
            </div>
          </div>
          @else
          <div class="form-group mb-1">
            <div class="checkbox">
                <label for="inputVerified">
                    <input type="checkbox" name="satus[]" class="text-capitalize status" value="0" >
                    Disable
                </label>
            </div>
          </div>
          @endif
    </div>
  </div>