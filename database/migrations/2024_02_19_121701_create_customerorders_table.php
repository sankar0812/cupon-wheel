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
        Schema::create('customerorders', function (Blueprint $table) {
            $table->id();
            $table->integer('customerid');
            $table->string('categoryid')->nullable();
            $table->string('menuid')->nullable();
            $table->string('quantitycount')->nullable();
            $table->string('totalamount')->nullable();
            $table->string('sugartype')->nullable();
            $table->integer('order_status')->default(1);
            $table->integer('order_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customerorders');
    }
};
