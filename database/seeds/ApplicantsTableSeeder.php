<?php

use Illuminate\Database\Seeder;
use App\Applicant;

class ApplicantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $applicants = [
          ['Hisham', 'Elhaggaz', 15, 1, '43724 Sweet Cherry Ln', 'Apt-5',null,'Canton',48188, 'Michigan','714-829-8926','hisham.mansour@gmail.com'],
          ['David', 'Larson', 7, 0, '2526 Ford Rd.', 'Bulding 8',null,'Wixom',42369, 'Michigan','248-568-6656','david.larson@gmail.com'],
      ];

      $count = count($applicants);

      foreach ($applicants as $key => $applicant) {
          Applicant::insert([
              'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
              'first_name' => $applicant[0],
              'last_name' => $applicant[1],
              'experience' => $applicant[2],
              'can_relocate' => $applicant[3],
              'address_line_1' => $applicant[4],
              'address_line_2' => $applicant[5],
              'address_line_3' => $applicant[6],
              'city' => $applicant[7],
              'zip' => $applicant[8],
              'state' => $applicant[9],
              'phone' => $applicant[10],
              'email' => $applicant[11]
          ]);
          $count--;
      }
    }
}
