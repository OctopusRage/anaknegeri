<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
   protected $fillable = [
    'item', 'amount', 'detail', 'withdraw_request_id'
  ];

  protected $guarded = ['id'];

   public function withdraw()
  {
  	return $this->belongsTo('App\Models\WithdrawRequest', 'withdraw_request_id');
  }
}
