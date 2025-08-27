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
        Schema::create('invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->integer('customer_id');
            $table->integer('branch_id')->nullable();
            $table->integer('subsc_id')->nullable();
            $table->string('amount');
            $table->dateTime('paid_at');
            $table->string('year');
            $table->string('month_year');
            // razorpay
            $table->string('razorpay_payment_id');
            $table->string('razorpay_entity')->nullable();
            $table->string('razorpay_amount')->nullable();
            $table->string('razorpay_currency')->nullable();
            $table->string('razorpay_status')->nullable();
            $table->string('razorpay_method')->nullable();
            $table->string('razorpay_email')->nullable();
            $table->string('razorpay_contact')->nullable();
            $table->string('razorpay_created_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_payments');
    }
};
