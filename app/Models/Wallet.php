<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
  protected $guarded = ['id'];

  public function user()
  {
  	return $this->belongsTo('App\Models\User', 'user_id');
  }

  public function deposit()
  {
  	return $this->hasMany('App\Models\WalletDeposit', 'wallet_id');
  }

  public function assignUser($user_id)
  {
  	return $this->user()->associate($user_id);
  }

  public function getTotalWallet()
  {
  	return $this->total;
  }
  
}
