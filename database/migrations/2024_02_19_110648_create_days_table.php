<?php

use App\Models\Day;
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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->string('day_name');
            $table->string('day_fullname');
            $table->integer('day_status')->default(1);
            $table->integer('day_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
        Day::insert([
            [
                'day_name' => 'Mon',
                'day_fullname' => 'Monday',
            ],
            [
                'day_name' => 'Tue',
                'day_fullname' => 'Tuesday',
            ],
            [
                'day_name' => 'Wed',
                'day_fullname' => 'Wednesday',
            ],
            [
                'day_name' => 'Thu',
                'day_fullname' => 'Thursday',
            ],
            [
                'day_name' => 'Fri',
                'day_fullname' => 'Friday',
            ],
            [
                'day_name' => 'Sat',
                'day_fullname' => 'Saturday',
            ],
            [
                'day_name' => 'Sun',
                'day_fullname' => 'Sunday',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
