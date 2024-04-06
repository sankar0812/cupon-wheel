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
        Schema::create('containers_details', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('container_given')->nullable();
            $table->string('container_get')->nullable();
            $table->string('date');
            $table->string('remaing_container')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('containers_details');
    }
};
