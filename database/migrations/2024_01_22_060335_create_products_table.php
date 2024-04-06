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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('pro_catid')->nullable();
            $table->string('pro_name')->nullable();
            $table->string('pro_slugname')->nullable();
            $table->longText('pro_description')->nullable();
            $table->float('pro_price')->nullable();
            $table->string('pro_file')->nullable();
            $table->tinyInteger('pro_status')->default(1); // 0: H
            $table->tinyInteger('pro_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
