<?php

use App\Models\Subscriptionplan;
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
        Schema::create('subscriptionplans', function (Blueprint $table) {
            $table->id();
            $table->string('Sub_title')->nullable();
            $table->string('Sub_description')->nullable();
            $table->string('sub_status')->default(1);
            $table->string('sub_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });

        Subscriptionplan::insert(
            [
                [
                    'Sub_title' => 'DAILY',
                    'sub_status' => 1,
                    'sub_delete' => 1,

                ],
                [
                    'Sub_title' => 'WEEKLY',
                    'sub_status' => 1,
                    'sub_delete' => 1,

                ],
                [
                    'Sub_title' => 'MONTHLY',
                    'sub_status' => 1,
                    'sub_delete' => 1,
                    
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptionplans');
    }
};
