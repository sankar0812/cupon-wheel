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
        Schema::create('container_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('container_id');
            $table->integer('quantity_count');
            $table->string('transaction_type'); // e.g., given, collected
            $table->dateTime('transaction_date');
            $table->string('transaction_month');
            $table->string('collected_date')->nullable();
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_transactions');
    }
};
