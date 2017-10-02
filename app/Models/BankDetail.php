<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'bank_name', 'bank_account', 'name', 'user_id'
    ];

    public function user(){
        $this->belongsTo('App\Models\User', 'user_id');
    }
}
