<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationRequest extends Model
{
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'confirmed', 'status', 'id_img', 'address', 'website', 'fb_id', 
        'twitter_id', 'instagram_id', 'user_id'
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    } 
    
    public function assignVerificationRequests($id){
    	return $this->user()->associate($id);
    }

    public function getStatus() {
        return $this->status == 1 ? "Organisasi" : "Non - Organisasi";
    }

    public function getConfirmation() {
        return $this->confirmed == 1 ? "Confirmed" : "Unconfirmed";
    }

}
