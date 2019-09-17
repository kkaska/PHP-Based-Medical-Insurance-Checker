<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Hospital', function (Blueprint $table) {
            $table->integer('Id');
            $table->string('Name');
            $table->string('StreetAddress');
            $table->string('City');
            $table->string('State');
            $table->string('Zip');  //Zip codes can start with 0

            $table->primary('Id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Hospital');
    }
}
