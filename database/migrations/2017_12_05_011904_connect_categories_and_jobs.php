<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectCategoriesAndJobs extends Migration
{
  public function up()
  {
      Schema::table('jobs', function (Blueprint $table) {

          $table->integer('category_id')->unsigned();

          $table->foreign('category_id')->references('id')->on('categories');

      });
  }

  public function down()
  {
      Schema::table('jobs', function (Blueprint $table) {

          $table->dropForeign('jobs_category_id_foreign');

          $table->dropColumn('category_id');
      });
  }
}
