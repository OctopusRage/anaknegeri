<!-- Modal untuk Add User -->

<div class="modal  fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="icon-user-follow"></i>&nbsp; Tambah User
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Silakan masukkan data utama User</h5>
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

            <div class="modal-footer">                
                <button type="button" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->