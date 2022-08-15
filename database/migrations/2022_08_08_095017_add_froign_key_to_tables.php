<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFroignKeyToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('family_id')->on('families')->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        $family = \App\Models\Family::create();

        \App\Models\User::create([
            'name' => 'علیرضا جعفری',
            'phone' => '09125193247',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'national_id' => '0021458744',
            'title' => 'سرپرست',
            'family_id' => 1,
            'family_owner' => 1,
        ]);

        $family->update(['owner_id'=>1]);

        \App\Models\User::create([
            'name' => 'امیرحسین نجفی',
            'phone' => '09125952248',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'national_id' => '0021458744',
            'title' => 'پسر',
            'family_id' => 1,
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->dropForeign('family_owner');
            $table->dropColumn('family_owner');

            $table->dropForeign('family_id');
            $table->dropColumn('family_id');
        });
    }
}
