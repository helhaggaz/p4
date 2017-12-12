<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('first_name');
            $table->string('last_name');
            $table->integer('experience');
            $table->boolean('can_relocate');

            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('address_line_3')->nullable($value = true);
            $table->string('city');
            $table->integer('zip');
            $table->string('state');
            $table->string('phone');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
