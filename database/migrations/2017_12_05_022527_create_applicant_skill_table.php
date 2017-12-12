<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantSkillTable extends Migration
{
  public function up()
  {
      Schema::create('applicant_skill', function (Blueprint $table) {

          $table->increments('id');
          $table->timestamps();

          $table->integer('applicant_id')->unsigned();
          $table->integer('skill_id')->unsigned();

          # Make foreign keys
          $table->foreign('applicant_id')->references('id')->on('applicants');
          $table->foreign('skill_id')->references('id')->on('skills');
      });
  }

  public function down()
  {
      Schema::dropIfExists('applicant_skill');
  }
}
