<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('DoctorId');
            $table->string('empId');
            $table->string('Name');
            $table->string('DOB');
            $table->string('Gender');
            $table->string('Phone');
            $table->string('Emergency')->nullable();
            $table->string('Email');
            $table->string('Address');
            $table->string('Department');
            $table->string('Specialist');
            $table->string('VisitingFee');
            $table->string('Commission');
            $table->string('ClosingDay');
            $table->string('ProfilePicture')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
