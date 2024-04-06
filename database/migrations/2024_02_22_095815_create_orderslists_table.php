<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orderslists', function (Blueprint $table) {
            $table->id();
            $table->string('ord_customerid')->nullable();
            $table->integer('ord_customer_subcid')->nullable();
            $table->string('ord_branchid')->nullable();
            $table->string('ord_categoryid')->nullable();
            $table->string('ord_quantityid')->nullable();
            $table->string('ord_quantitycount')->nullable();
            $table->string('ord_sugartype')->nullable();
            $table->string('ord_session')->nullable();
            $table->string('ord_amount')->nullable();
            $table->string('ord_ass_deliveryboy')->nullable();
            $table->string('ord_paymentstatus')->nullable();
            $table->string('ord_deliverystatus')->nullable();
            $table->string('ord_packingstatus')->nullable();
            $table->string('ord_ordertype')->nullable();
            $table->string('ord_payment_recvdate')->nullable();
            $table->integer('ord_invoiceid')->nullable();
            $table->string('ord_date')->nullable();
            $table->string('ord_week')->nullable();
            $table->string('ord_month')->nullable();
            $table->string('ord_dayname')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderslists');
    }
};
