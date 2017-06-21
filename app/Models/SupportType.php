<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportType extends Model
{
  protected $fillable = ['type'];

  public function campaigns()
  {
      return $this->belongsToMany('App\Models\Campaign')->withTimestamps();;
  }

  public function support()
  {
      return $this->hasMany('App\Models\Support', 'type_id');
  }

}
