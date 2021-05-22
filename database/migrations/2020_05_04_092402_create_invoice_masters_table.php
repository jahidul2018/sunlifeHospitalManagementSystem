<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoiceNo');
            $table->string('invoiceDate');
            $table->string('patientId');
            $table->string('patientName');
            $table->string('patientPhone');
            $table->string('totalCost');
            $table->string('discount');
            $table->string('netAmount');
            $table->string('paidAmount');
            $table->string('dueAmount');
            $table->string('givenAmount');
            $table->string('returnAmount');
            $table->string('paymentType');
            $table->string('status');
            $table->string('reportDelivery');
            $table->string('deliveryDate');
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
        Schema::dropIfExists('invoice_masters');
    }
}
