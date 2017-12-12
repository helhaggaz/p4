<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  public function category()
  {
      return $this->belongsTo('App\Category');
  }
  public function skills()
  {
      return $this->belongsToMany('App\Skill')->withTimestamps();
  }
}
