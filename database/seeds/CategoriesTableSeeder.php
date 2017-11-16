<?php

use Illuminate\Database\Seeder;
use App\Category;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = [
          ['Information Technology'],
		      ['Finance and Accounting'],
      ];

      $count = count($categories);

      foreach ($categories as $key => $category) {
          Category::insert([
              'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'name' => $category[0]
          ]);
          $count--;
      }
    }
}
