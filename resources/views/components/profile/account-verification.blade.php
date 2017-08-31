@if(!$user->verified)
<h5 class="mb-4">
	Verifikasi Akun
</h5>
<div class="bg-info mb-3 p-2">
    <div class="row">
        <div class="col-md-auto display-4">
            <i class="icon-exclamation align-middle"></i>
        </div>
        <div class="col-md-9">
            Mengapa harus melakukan verifikasi akun?  Verifikasi akun ini dibutuhkan jika anda ingin membuat suatu campaign. 
            Dengan adanya verifikasi ini diharapkan akan mengurangi pemungutan dana yang tidak resmi oleh 
            pihak yang tidak bertanggung jawab.
        </div>
    </div>
</div>
<form action="{{route('profile.postVerification', $user->id)}}" method="POST" enctype="multipart/form-data">
<div class="checkbox">
    <label class="switch switch-icon switch-primary-outline-alt checkbox-inline mb-3">
        <input type="checkbox" name="isOrganization" value="true" class="switch-input "> 
        <span class="switch-label" data-on="" data-off=""></span>
        <span class="switch-handle"></span>
    </label>
    <label class="switch  pl-3">
        Akun ini milik organisasi resmi
    </label>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group  mb-3">
            <label for="v-name">Nama</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-user"></i>
                </span>
                <input name="name2" type="text" class="form-control" placeholder="Nama">
            </div>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('name2')}}
            @endif
            </span>
        </div>

        <div class="form-group  mb-3">

            <label for="name">Nomor Telfon</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-phone"></i></span>
                <input name="phone_number" type="text" class="form-control" placeholder="Nomor Telfon">
            </div>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('phone_number')}}
            @endif
            </span>
        </div>

        <div class="form-group  mb-3">

            <label for="name">Link Social Media</label>
            <div class="input-group">
                <span class="input-group-addon"></i>&nbsp; http://</span>
                <input name="id_img" type="text" class="form-control" placeholder="Website">
            </div>
            <span class="help-block ">
            @if ($errors->any())
                {{$errors->first('id_img')}}
            @endif
            </span>
            
            <div class="input-group mt-3">
                <span class="input-group-addon"></i>&nbsp; https://facebook.com/</span>
                <input name="fb_id" type="text" class="form-control" placeholder="Facebook">
            </div>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('fb_id')}}
            @endif
            </span>
            
            <div class="input-group mt-3">
                <span class="input-group-addon"></i>&nbsp; https://twitter.com/</span>
                <input name="twitter_id" type="text" class="form-control" placeholder="Twitter">
            </div>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('twitter_id')}}
            @endif
            </span>
            
            <div class="input-group mt-3">
                <span class="input-group-addon"></i>&nbsp; https://instagram.com/</span>
                <input name="instagram_id" type="text" class="form-control" placeholder="Instagram">
            </div>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('instagram_id')}}
            @endif
            </span>
            
        </div>

        <div class="form-group  mb-3">

            <label for="name">Scan KTP</label><br>
            <input type="file" name="id_img" ><br>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('id_img')}}
            @endif
            </span>
        </div>
        <div class="form-group mb-3">
            <label for="address">Alamat</label>
            <textarea id="textarea-input" name="address2" rows="5" class="form-control" placeholder="Silakan tulis alamat fisik anda">{{$user->address2}}</textarea>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('address2')}}
            @endif
            </span>
        </div>
        <div class="form-group mb-3">
            <label for="address">Info Tambahan</label>
            <textarea id="textarea-input" name="additional_info" rows="5" class="form-control" placeholder="Silakan masukkan informasi tambahan tentang organisasi anda"></textarea>
            <span class="help-block">
            @if ($errors->any())
                {{$errors->first('additional_info')}}
            @endif
            </span>
        </div>
        <input type="submit" class="btn btn-success" value="Verifikasi Akun!"/>
        
    </div>

</div>
</form>
@endif