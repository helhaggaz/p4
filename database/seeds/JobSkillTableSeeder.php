<?php

use Illuminate\Database\Seeder;
use App\Job;
use App\Skill;

class JobSkillTableSeeder extends Seeder
{
  public function run()
  {
      $jobs =[
          'Application Developer I' => ['java', 'PHP', 'English Language', 'SQL'],
          'Accountant II' => ['English Language', 'Chinese Language', 'Finance', 'Income Tax']
      ];

      foreach ($jobs as $title => $skills) {

          $job = Job::where('title', 'like', $title)->first();

          foreach ($skills as $skillName) {
              $skill = Skill::where('name', 'LIKE', $skillName)->first();

              $job->skills()->save($skill);
          }
      }
  }
}
