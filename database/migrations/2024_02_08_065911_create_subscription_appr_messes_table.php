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
        Schema::create('subscription_appr_messes', function (Blueprint $table) {
            $table->id();
            $table->integer('subapprmess_subsid')->nullable();
            $table->string('subapprmess_customerid')->nullable();
            $table->dateTime('subapprmess_datetime');
            $table->text('subapprmess_can_cha')->nullable();
            $table->text('subapprmess_message')->nullable();
            $table->integer('subapprmess_status')->default(1);
            $table->integer('subapprmess_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_appr_messes');
    }
};
