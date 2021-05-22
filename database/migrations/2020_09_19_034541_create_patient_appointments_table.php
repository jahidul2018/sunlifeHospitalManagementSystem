<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('appointmentDate');
            $table->string('bookingDate');
            $table->string('appointmentDay');
            $table->string('appointmentTime');
            $table->string('drName');
            $table->string('patientName');
            $table->string('patientId');
            $table->string('pContact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_appointments');
    }
}
