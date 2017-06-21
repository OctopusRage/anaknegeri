<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
   protected $fillable = [
        'item', 'comment', 'detail', 'amount', 'anonim'
    ];

    protected $guarded = ['id'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id');

    } 

    public function campaign()
    {
    	return $this->belongsTo('App\Models\Campaign', 'campaign_id');

    }

    public function supportType()
    {
    	return $this->belongsTo('App\Models\SupportType', 'type_id');

    }

    public function assignUser($id)
    {

      return $this->user()->associate($id);
    }

    public function assignCampaign($id)
    {

      return $this->campaign()->associate($id);
    }

    public function assignType($id)
    {

      return $this->supportType()->associate($id);
    }

    public function getName()
    {
        if($this->anonim==true)
        {
            return "Anonim";
        }
        else
        {
            return $this->user->name;
        }
    }
}
