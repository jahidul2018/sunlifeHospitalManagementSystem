<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientlistMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patientlist_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patientId');
            $table->string('name');
            $table->string('contact');
            $table->string('gender');
            $table->string('age');
            $table->string('type');
            $table->string('registerDate');
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
        Schema::dropIfExists('patientlist_masters');
    }
}
