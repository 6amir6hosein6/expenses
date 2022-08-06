<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        \App\Models\User::create([
            'name'=>'seirani',
            'password' => \Illuminate\Support\Facades\Hash::make('09125952248'),
            'phone' => '09125952248',
        ]);

        \App\Models\User::create([
            'name'=>'seirani',
            'password' => \Illuminate\Support\Facades\Hash::make('09141248299'),
            'phone' => '09141248299',
        ]);

        \App\Models\User::create([
            'name'=>'seirani',
            'password' => \Illuminate\Support\Facades\Hash::make('09149241945'),
            'phone' => '09149241945',
        ]);

        \App\Models\User::create([
            'name'=>'seirani',
            'password' => \Illuminate\Support\Facades\Hash::make('09148290018'),
            'phone' => '09148290018',
        ]);

        \App\Models\User::create([
            'name'=>'seirani',
            'password' => \Illuminate\Support\Facades\Hash::make('09145020488'),
            'phone' => '09145020488',
        ]);

        \App\Models\User::create([
            'name'=>'seirani',
            'password' => \Illuminate\Support\Facades\Hash::make('09142298240'),
            'phone' => '09142298240',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
