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
        Schema::create('customer_registers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cust_id')->nullable();
            $table->string('cust_phone')->nullable()->unique();
            $table->string('branch_id')->nullable();
            $table->string('cust_businessname')->nullable();
            $table->string('cust_personname')->nullable();
            $table->longText('cust_deliveryaddress')->nullable();
            $table->longText('cust_billingaddress')->nullable();
            $table->string('cust_emailaddress')->nullable();
            $table->string('cust_gstnumber')->nullable();
            $table->string('cust_password');
            $table->string('cust_subcplan')->nullable();
            $table->integer('cust_loginacs')->default(2);
            $table->string('cust_regdate')->nullable();
            $table->integer('cust_status')->default(1);
            $table->integer('cust_delete')->default(1);
            $table->integer('cust_otp')->nullable();
            $table->string('qrcode_path')->nullable();
            $table->string('qrcode')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_registers');
    }
};
