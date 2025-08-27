<?php

use App\Models\Addsubscriptionplan;
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
        Schema::create('addsubscriptionplans', function (Blueprint $table) {
            $table->id();
            $table->integer('addsub_subid');
            $table->longText('addsub_content')->nullable();
            $table->integer('addsub_status')->default(1);
            $table->integer('addsub_delete')->default(1);
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });

        Addsubscriptionplan::insert(
            [
                // Daily plan
                [
                    'addsub_subid' => '1',
                    'addsub_content' => 'Daily Payment',
                    'branch_id' => 1,
                ],
                [
                    'addsub_subid' => '1',
                    'addsub_content' => 'Morning Between 9.30 AM to 11 AM & Evening Between 3 PM to 4.30 PM',
                    'branch_id' => 1,
                ],
                [
                    'addsub_subid' => '1',
                    'addsub_content' => '(Mon - SUN)',
                    'branch_id' => 1,
                ],

                [
                    'addsub_subid' => '1',
                    'addsub_content' => 'Online pay',
                    'branch_id' => 1,
                ],
                [
                    'addsub_subid' => '1',
                    'addsub_content' => 'Tea, Coffe, Snacks',
                    'branch_id' => 1,
                ],
                // weekly plan
                [
                    'addsub_subid' => '2',
                    'addsub_content' => 'Weekly Payment',
                    'branch_id' => 1,

                ],
                [
                    'addsub_subid' => '2',
                    'addsub_content' => 'Morning Between 9.30 AM to 11 AM & Evening Between 3 PM to 4.30 PM',
                    'branch_id' => 1,
                ],
                [
                    'addsub_subid' => '2',
                    'addsub_content' => '(Mon - SUN)',
                    'branch_id' => 1,
                ],
                [
                    'addsub_subid' => '2',
                    'addsub_content' => 'Online pay',
                    'branch_id' => 1,
                ],
                [
                    'addsub_subid' => '2',
                    'addsub_content' => 'Tea, Coffe, Snacks',
                    'branch_id' => 1,
                ],

                //monthly  plan
                [
                    'addsub_subid' => '3',
                    'addsub_content' => 'Monthly Payment',
                    'branch_id' => 1,

                ],
                [
                    'addsub_subid' => '3',
                    'addsub_content' => 'Morning Between 9.30 AM to 11 AM & Evening Between 3 PM to 4.30 PM',
                    'branch_id' => 1,
                ],
                [
                    'addsub_subid' => '3',
                    'addsub_content' => '(Mon - SUN)',
                    'branch_id' => 1,
                ],
                [
                    'addsub_subid' => '3',
                    'addsub_content' => 'Online pay',
                    'branch_id' => 1,
                ],
                [
                    'addsub_subid' => '3',
                    'addsub_content' => 'Tea, Coffe, Snacks',
                    'branch_id' => 1,
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addsubscriptionplans');
    }
};
