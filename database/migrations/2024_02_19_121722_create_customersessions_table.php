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
        Schema::create('customersessions', function (Blueprint $table) {
            $table->id();
            $table->integer('customerid')->nullable();
            $table->string('session_morn')->nullable();
            $table->string( 'session_even' )->nullable();
            $table->integer('session_status')->default(1);
            $table->integer('session_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customersessions');
    }
};
