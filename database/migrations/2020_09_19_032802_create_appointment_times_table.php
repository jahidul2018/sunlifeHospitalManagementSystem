<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DrId');
            $table->string('DrName');
            $table->string('DayName');
            $table->string('TimeSchedule');
            $table->string('Shift');
            $table->string('TotalDuration');
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
        Schema::dropIfExists('appointment_times');
    }
}
