<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('type')->default(false); //add type boolean Users: 0=>User, 1=>superadmin, 2=>delivery, 3=>customer
            $table->integer('role')->default(1);
            $table->integer('status')->default(1);
            $table->integer('branch_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::insert(
            [
                [
                    'name' => 'ideaux',
                    'email' => 'adminideaux@gmail.com',
                    'password' => Hash::make('98659865'),
                    'type' => 2,
                    'role' => 2,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'branch_id' => 1,

                ],
                [
                    'name' => 'zicafe',
                    'email' => 'adminzicafe@gmail.com',
                    'password' => Hash::make('123123123'),
                    'type' => 2,
                    'role' => 2,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'branch_id' => 1,
                ],
                [
                    'name' => 'Deliver',
                    'email' => 'delivery@gmail.com',
                    'password' => Hash::make('98659865'),
                    'type' => 3,
                    'role' => 2,
                    'status' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'branch_id' => 1,
                ]
            ]
        );
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
