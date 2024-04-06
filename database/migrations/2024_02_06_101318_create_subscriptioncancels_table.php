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
        Schema::create('subscriptioncancels', function (Blueprint $table) {
            $table->id();
            $table->integer('subcan_subsid')->nullable();
            $table->string('subcan_customerid')->nullable();
            $table->dateTime('subcan_datetime');
            $table->dateTime('subcan_apprdatetime')->nullable();
            $table->text('subcan_reason')->nullable();
            $table->integer('subcan_status')->default(2);
            $table->integer('subcan_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptioncancels');
    }
};
