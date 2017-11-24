<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'subtitle', 'deadline', 'address', 'slug', 'feature_img', 'detail'
    ];

    protected $guarded = ['id'];


   	public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function supportType()
    {
        return $this->belongsToMany('App\Models\SupportType')->withTimestamps()->withPivot('id', 'item', 'amount');
    }

    public function support()
    {
        return $this->hasMany('App\Models\Support', 'campaign_id');
    }

    public function withdraw()
    {
        return $this->hasMany('App\Models\WithdrawRequest', 'campaign_id');
    }
    // Assign Campaign Category
    public function assignCategory($category)
    {
        return $this->category()->associate($category);
    }

    // Assign Support Needed by Campaign
    public function assignSupportNeed($type, $item, $amount){
        return $this->supportType()->attach($type, [
                'item'          => $item,
                'amount'        => $amount
            ]);
    }
    //Assign User
    public function assignUser($id){
        return $this->user()->associate($id);
    }

    public function deactivate()
    {
        $this->status = false;
        $this->save();
    }


    public function isActive($status)
    {   
        if($this->status == $status){
            return true;
        }
        return false;
    }

    public function getStatusFinansial()
    {
        $progress = 0.0;

        foreach( $this->support as $support)
        {
            if($support->item == "Dana")
            {   
                $progress = $progress + $support->amount;
            }
        }
        return $progress;
    }

    public function getNeed()
    {
        $need = 0.0;
        foreach( $this->supportType as $type)
        {
            if($type->pivot->item == "Dana")
            {   
                $need = $type->pivot->amount;
            }
        }
        return $need;
    }

    public function getProgress()
    {
        

        $need= $this->getNeed();
        $progress= $this->getStatusFinansial();
        

        $precentage = ($progress / $need)*100;
        return number_format((float)$precentage, 2, '.', '');
    }

    public function getStatusWithdraw()
    {
        $withdrawed = 0.0;
        $withdraw = $this->withdraw()->where('status', '=',true)->get();

        foreach( $withdraw as $withdraw)
        {
            if($withdraw->item == "Dana")
            {   
                $withdrawed = $withdrawed + $withdraw->amount;
            }
        }
        return $withdrawed;
    }

    public function getAvailableForWithdraw()
    {
        $available = 0.0;
        $available = $this->getStatusFinansial() - $this->getStatusWithdraw();
        return $available;
    }
    
    public function isSuccess()
    {
        if($this->getStatusFinansial() >= $this->getNeed())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}	
