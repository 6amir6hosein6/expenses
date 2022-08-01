<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSafisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safis', function (Blueprint $table) {
            $table->id();

            $table->integer('load_id');
            $table->string('load_owner_name');
            $table->string('load_driver')->nullable();

            $table->integer('do_price')->default(0);
            $table->integer('hire')->default(0);
            $table->integer('discharge')->default(0);
            $table->integer('weighbridge')->default(0);
            $table->integer('handy')->default(0);

            $table->string('date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('safis');
    }
}
