<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'activated', 'verified', 'mobile_no', 'date','bio', 'profile_img','banner_img'
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

    // Define Relations
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function campaign()
    {
        return $this->hasMany('App\Models\Campaign', 'created_by');
    }

    public function support()
    {
        return $this->hasMany('App\Models\Support', 'user_id');
    } 

    public function activationRequests()
    {
        return $this->hasMany('App\Models\ActivationRequest', 'user_id');
    } 

    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet', 'user_id');
    }

    // Role Relation
    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }

        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    public function activated()
    {
        $this->activated = true;
        $this->save();
    }
    public function isActive($status)
    {   
        if($this->activated == $status){
            return true;
        }
        return false;
    }

    public function deactivate(){
        $this->status = false;
        $this->save();
    }

    public function verified()
    {
        $this->verified = true;
        $this->save();
    }

    public function isVerified($status)
    {   
        if($this->verified == $status){
            return true;
        }
        return false;
    }

}   