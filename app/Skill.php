<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{

  public static function getForChosenSelect()
 {
     $skills = Skill::orderBy('name')->get();
     foreach ($skills as $skill) {
        $skillsForChosenSelect[$skill->id] = $skill->name;
      }
      return $skillsForChosenSelect;
  }
  public function jobs() {
      return $this->belongsToMany('App\Job')->withTimestamps();
  }
  public function applicants() {
      return $this->belongsToMany('App\Applicant')->withTimestamps();
  }

}
