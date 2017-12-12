<?php

use Illuminate\Database\Seeder;
use App\Job;
use App\Category;

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
          ['Application Developer I', 'Java and PHP Programmer, Level 1', 'Information Technology', 0, 7],
          ['Accountant II', 'Jonior Accountant', 'Finance and Accounting', 0, 1],
      ];

      $count = count($jobs);

      foreach ($jobs as $key => $job) {
          $category_id = Category::where('name', '=', $job[2])->pluck('id')->first();
          Job::insert([
              'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'title' => $job[0],
              'description' => $job[1],
              'category_id' => $category_id,
              'only_local' => $job[3],
              'min_exp' => $job[4]
          ]);
          $count--;
      }
    }
}
