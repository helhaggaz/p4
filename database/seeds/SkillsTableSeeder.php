<?php

use Illuminate\Database\Seeder;
use App\Skill;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $skills = [
          ['Java'],
		      ['PHP'],
          ['SQL'],
		      ['Networking'],
		      ['Security'],
		      ['LDAP Administration'],
		      ['Management'],
		      ['Comunication'],
		      ['Leadership'],
		      ['Chinese Language'],
		      ['English Language'],
		      ['Finance'],
		      ['Procurement'],
		      ['Income Tax'],
      ];

      $count = count($skills);

      foreach ($skills as $key => $skill) {
          Skill::insert([
              'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'name' => $skill[0]
          ]);
          $count--;
      }
    }
}
