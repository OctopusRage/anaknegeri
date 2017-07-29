<h5 class="mb-4">
	Update Akun
</h5>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <form action="{{route('profile.postEditAccount', $user->id)}}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group  mb-3">
            <label for="name">Nama Lengkap</label>
            <div class="input-group has-{{$errors->first('name')!=null?'danger':''}}">
                <span class="input-group-addon"><i class="icon-user"></i>
                </span>
                <input name="name" type="text" class="form-control" placeholder="Nama Lengkap" value="{{$user->name}}">
            </div>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('name')}}
            @endif
            </span>
        </div>

        <div class="form-group  mb-3">
            <label for="birthdate">Tanggal Lahir</label>
            <div class="input-group has-{{$errors->first('birthdate')!=null?'danger':''}}">
                <span class="input-group-addon"><i class="icon-calendar"></i>
                </span>
                <input type="text" name="birthdate" class="form-control" placeholder="Tanggal Lahir" value="{{$user->date}}">
            </div>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('birthdate')}}
            @endif
            </span>
        </div>
        
        <div class="form-group  mb-3">
            <label for="file_profile">Foto Profile</label><br>
            <input type="file" name="file_profile" ><br>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('file_profile')}}
            @endif
            </span>
        </div>

        @if(Auth::user()->hasRole('organization'))
        <div class="form-group  mb-3">

            <label for="file_banner">Banner</label><br>
            <input type="file" name="file_banner" ><br>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('file_banner')}}
            @endif
            </span>
        </div>
        @endif
        <div class="form-group mb-3">
            <label for="bio">Bio</label>
            <textarea id="textarea-input" name="bio" rows="5" class="form-control" placeholder="Ceritakan sedikit tentang anda">{{$user->bio}}</textarea>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('bio')}}
            @endif
            </span>
        </div>
        <div class="form-group mb-3">
            <label for="address">Alamat</label>
            <textarea id="textarea-input" name="address" rows="5" class="form-control" placeholder="Silakan tulis alamat fisik anda">{{$user->address}}</textarea>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('address')}}
            @endif
            </span>
        </div>
        <input type="submit" class="btn btn-primary" value="Update Akun!"/>
        </form>
    </div>
</div>