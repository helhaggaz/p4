<?php

use Illuminate\Database\Seeder;
use App\Applicant;
use App\Skill;

class ApplicantSkillTableSeeder extends Seeder
{
  public function run()
  {
      $applicants =[
          'Elhaggaz, Hisham' => ['java', 'PHP', 'English Language', 'SQL', 'Networking', 'Security'],
          'Larson, David' => ['English Language', 'Income Tax', 'Procurement', 'Leadership']
      ];

      foreach ($applicants as $name => $skills) {

          $applicant = Applicant::where(DB::raw('CONCAT(last_name, ", ",first_name)'), 'like', $name)->first();

          foreach ($skills as $skillName) {
              $skill = Skill::where('name', 'LIKE', $skillName)->first();

              $applicant->skills()->save($skill);
          }
      }
  }
}
