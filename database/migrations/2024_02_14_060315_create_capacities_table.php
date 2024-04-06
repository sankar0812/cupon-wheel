<?php

use App\Models\Capacity;
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
        Schema::create('capacities', function (Blueprint $table) {
            $table->id();
            $table->string('capa_lit')->nullable();
            $table->string('capa_per_cup')->nullable();
            $table->integer('capa_type')->nullable();
            $table->integer('capa_status')->default(1);
            $table->integer('capa_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });

        Capacity::insert([
            [
                'capa_lit' => '1 litre',
                'capa_per_cup' => '12 cups',
                'capa_type' => 1,
            ],
            [
                'capa_lit' => '500 ml',
                'capa_per_cup' => '6 cups',
                'capa_type' => 1,
            ],
            [
                'capa_lit' => '350 ml',
                'capa_per_cup' => ' 4 cups',
                'capa_type' => 1,
            ],
            [
                'capa_lit' => '1 piece',
                'capa_per_cup' => '1 person',
                'capa_type' => 2,
            ],
            // [
            //     'capa_lit' => '1 packet',
            //     'capa_per_cup' => '1 person',
            //     'capa_type' => 2,
            // ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacities');
    }
};
