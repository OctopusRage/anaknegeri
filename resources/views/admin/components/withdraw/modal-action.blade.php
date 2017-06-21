<div class="modal  fade" id="actionWithdraw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="icon-question"></i>&nbsp; Konfirmasi
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <div id="detailAction"></div>
               <div class="form-group mt-3">
                   <textarea name="addition" id="inputAddition" rows="5" placeholder="Keterangan tambahan untuk konfirmasi penarikan ini." class="form-control"></textarea>
               </div>
            </div>

            <div class="modal-footer">                
                <button type="button" id="btnAccept" class="btn btn-success confirm">Accept</button>
                <button type="button" id="btnReject" class="btn btn-danger confirm">Reject</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>