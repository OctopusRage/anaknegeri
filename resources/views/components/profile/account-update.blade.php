<h5 class="mb-4">
	Update Akun
</h5>
<div class="row">
    <div class="col-md-12 col-sm-12">
        
        <div class="form-group  mb-3">
            <label for="name">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-user"></i>
                </span>
                <input type="text" class="form-control" placeholder="Nama Lengkap">
            </div>
            <span class="help-block">Pesan error</span>
        </div>

        <div class="form-group  mb-3">
            <label for="name">Tanggal Lahir</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-calendar"></i>
                </span>
                <input type="text" class="form-control" placeholder="Tanggal Lahir">
            </div>
            <span class="help-block">Pesan error</span>
        </div>
        
        <div class="form-group  mb-3">

            <label for="name">Foto Profile</label><br>
            <input type="file" name="id_img" ><br>
            <span class="help-block">Pesan error</span>
        </div>

        @if(Auth::user()->hasRole('organization'))
        <div class="form-group  mb-3">

            <label for="name">Banner</label><br>
            <input type="file" name="id_img" ><br>
            <span class="help-block">Pesan error</span>
        </div>
        @endif
        <div class="form-group mb-3">
            <label for="name">Bio</label>
            <textarea id="textarea-input" name="textarea-input" rows="5" class="form-control" placeholder="Ceritakan sedikit tentang anda"></textarea>
            <span class="help-block">Pesan error</span>
        </div>
        <div class="form-group mb-3">
            <label for="name">Alamat</label>
            <textarea id="textarea-input" name="textarea-input" rows="5" class="form-control" placeholder="Silakan tulis alamat fisik anda"></textarea>
            <span class="help-block">Pesan error</span>
        </div>

        <button type="button" class="btn btn-primary">Update Akun!</button>
    </div>
</div>