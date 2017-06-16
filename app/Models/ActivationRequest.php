<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivationRequest extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token'
    ];

    protected $guarded = ['id'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    } 
    
    public function assignActivationRequests($id){
    	return $this->user()->associate($id);
    }

}
