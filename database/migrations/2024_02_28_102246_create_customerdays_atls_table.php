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
        Schema::create('customerdays_atls', function (Blueprint $table) {
            $table->id();
            $table->integer('customerid')->nullable();
            $table->string('day_name')->nullable();
            $table->integer('day_status')->default(1);
            $table->integer('day_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customerdays_atls');
    }
};
