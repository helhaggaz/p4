<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $jobs = [
          ['Application Developer I', 'Java and PHP Programmer, Level 1', 1, 0, 7, 1],
    ['Accountant II', 'Jonior Accountant', 2, 0, 1, 2],
      ];

      $count = count($jobs);

      foreach ($jobs as $key => $job) {
          Job::insert([
              'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'title' => $job[0],
              'description' => $job[1],
              'category_id' => $job[2],
              'only_local' => $job[3],
      'min_exp' => $job[4],
              'skills' => $job[5]
          ]);
          $count--;
      }
    }
}
