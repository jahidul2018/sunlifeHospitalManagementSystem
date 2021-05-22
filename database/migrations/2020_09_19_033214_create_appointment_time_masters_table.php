<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentTimeMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_time_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DrId');
            $table->string('DrName');
            $table->string('Shift');
            $table->string('TimeDuration');
            $table->string('DayName');
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
        Schema::dropIfExists('appointment_time_masters');
    }
}
