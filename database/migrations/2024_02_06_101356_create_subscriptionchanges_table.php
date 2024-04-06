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
        Schema::create('subscriptionchanges', function (Blueprint $table) {
            $table->id();
            $table->integer('subcha_subsid')->nullable();
            $table->string('subcha_customerid')->nullable();
            $table->dateTime('subcha_datetime');
            $table->dateTime('subcha_apprdatetime')->nullable();
            $table->text('subcha_reason')->nullable();
            $table->integer('subcha_status')->default(2);
            $table->integer('subcha_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptionchanges');
    }
};
