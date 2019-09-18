<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TreatmentDetails', function (Blueprint $table) {
            $table->integer('DrgId');
            $table->integer('HospitalId');
            $table->double('AverageCoveredCharges');
            $table->double('AverageTotalPayments');
            $table->double('AverageMedicarePayments');
            $table->integer('Year');
            $table->integer('TotalDischarges');

            $table->primary(['DrgId', 'HospitalId', 'Year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TreatmentDetails');
    }
}
