<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletDeposit extends Model
{
  protected $fillable = [
      'token', 'amount', 'image', 'status', 'wallet_id'
  ];

  protected $guarded = ['id'];

  public function wallet()
  {
  	return $this->belongsTo('App\Models\Wallet', 'wallet_id');
  }

  public function confirmed()
  {
  	$this->confirmed = true;
  	$this->save();
  }

  public function accepted()
  {
  	$this->status=true;
  	$this->save();
    $add = $this->amount;
    $total = $add + $this->wallet()->total;
    $this->wallet()->total = $total;
    $this->wallet()->save();
  }

  public function assignWallet($id)
  {
  	return $this->wallet()->associate($id);
  }


  public function getStatus(){
    if( $this->confirmed == true){
      if( $this->status == true){
        return "Accepted";
      }else{
        return "Rejected";
      }
    }else{
        return "Pending";
    }
  }

}
