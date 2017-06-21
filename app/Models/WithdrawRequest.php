<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
  protected $fillable = [
    'item', 'amount', 'detail', 'confirmed', 'status'
  ];

  protected $guarded = ['id'];

  public function campaign()
  {
  	return $this->belongsTo('App\Models\Campaign', 'campaign_id');
  }

  public function report()
  {
  	return $this->hasOne('App\Models\Report', 'withdraw_request_id');
  }

  public function confirmed()
  {
  	$this->confirmed = true;
  	$this->save();
  }

  public function accepted()
  {
    $this->status=true;
  	$this->confirmed=true;
  	$this->save();
    $add = $this->amount;
  }

  public function rejected()
  {
    $this->status=false;
    $this->confirmed=true;
    $this->save();
  }

  public function sent()
  {
    $this->status = 2;
    $this->save();
  }

  public function assignCampaign($id)
  {
  	return $this->campaign()->associate($id);
  }


  public function getStatus(){
    if( $this->confirmed == "1"){
      if( $this->status == "1"){
        return "Accepted";
      }else if($this->status == "2"){
      	return "Dikirim";
      }else{
        return "Rejected";
      }
    }else{
        return "Pending";
    }
  }

}	
