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
        return $this->belongsToMany('App\Models\SupportType')->withTimestamps()->withPivot('item', 'amount');
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

}	
