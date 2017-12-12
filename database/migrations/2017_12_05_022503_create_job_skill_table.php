<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSkillTable extends Migration
{
  public function up()
  {
      Schema::create('job_skill', function (Blueprint $table) {

          $table->increments('id');
          $table->timestamps();

          $table->integer('job_id')->unsigned();
          $table->integer('skill_id')->unsigned();

          # Make foreign keys
          $table->foreign('job_id')->references('id')->on('jobs');
          $table->foreign('skill_id')->references('id')->on('skills');
      });
  }

  public function down()
  {
      Schema::dropIfExists('job_skill');
  }
}
