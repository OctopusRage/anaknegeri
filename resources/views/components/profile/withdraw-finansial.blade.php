 <div class="card">
  <div class="card-block p-0 clearfix">
      <i class="icon-wallet bg-info p-4 font-2xl mr-3 float-left"></i>
      <div class="h5 text-info mb-0 pt-3">Rp. {{ $campaign->getStatusFinansial() }}</div>
      <div class="text-muted text-uppercase font-weight-bold font-xs">Saldo Dompet</div>
  </div>
</div>
<div class="form-group {{ $errors->has('amount') ? ' has-danger' : '' }}  mb-3">
  <label for="inputAmount">Jumlah Penarikan</label>
  <div class="input-group">
    <span class="input-group-addon">Rp. </span>
    <input type="number" class="form-control" name="amount" id="inputAmount">
  </div>
</div>

<div class="form-group {{ $errors->has('amount') ? ' has-danger' : '' }}  mb-3">
  <label for="inputAmount">Jumlah Penarikan</label>
  <textarea class="form-control" name="detail"></textarea>
</div>