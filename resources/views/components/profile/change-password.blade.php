<h5 class="mb-3">
	Ubah Password
</h5>
<form action="{{route('profile.postEditPassword', $user->id)}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group  mb-3">
        
    <label for="password">Password lama</label>
    <div class="input-group has-{{$errors->first('old_password')!=null?'danger':''}}">
        <span class="input-group-addon"><i class="icon-lock"></i>
        </span>
        <input name="old_password" type="password" class="form-control" placeholder="Password Lama">
    </div>
    <span class="help-block">{{$errors->first('old_password')}}</span>
</div>
<div class="form-group  mb-3">
    
    <label for="password">Password baru</label>
    <div class="input-group has-{{$errors->first('old_password')!=null?'danger':''}}">
        <span class="input-group-addon"><i class="icon-lock"></i>
        </span>
        <input name="new_password" type="password" class="form-control" placeholder="Password Baru">
    </div>
    <span class="help-block">{{$errors->first('new_password')}}</span>
</div>
<div class="form-group  mb-3">

    <label for="password">Konfirmasi Password Baru</label>
    <div class="input-group has-{{$errors->first('old_password')!=null?'danger':''}}">
        <span class="input-group-addon"><i class="icon-lock"></i>
        </span>
        <input name="password_confirmation" type="password" class="form-control" placeholder="Konfirmassi Password Baru">
    </div>
    <span class="help-block">{{$errors->first('password_confirmation')}}</span>
</div>
<input type="submit" class="btn btn-primary" value="Ubah"/>
</form>