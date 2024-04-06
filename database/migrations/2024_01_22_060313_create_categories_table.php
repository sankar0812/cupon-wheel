<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('cat_name')->nullable();
            $table->string('cat_slugname')->nullable();
            $table->string('cat_file')->nullable();
            $table->integer('cat_status')->default(1);
            $table->integer('cat_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });

        // Category::insert([
        //     [
        //         'cat_name' => 'Drinks',
        //         'cat_slugname' => 'drinks'
        //     ],
        //     [
        //         'cat_name' => 'Snacks',
        //         'cat_slugname' => 'snacks'
        //     ],
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
