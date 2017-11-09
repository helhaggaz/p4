<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantContactInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_contact_info', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('addr_line_1');
            $table->string('addr_line_2');
            $table->string('addr_line_3')->nullable($value = true);
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
        Schema::dropIfExists('applicant_contact_info');
    }
}
