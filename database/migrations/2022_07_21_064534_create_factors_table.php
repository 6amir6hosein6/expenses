<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factors', function (Blueprint $table) {
            $table->id();
            $table->string('date');

            $table->integer('customer_id');
            $table->string('customer_name');

            $table->integer('load_id');
            $table->string('load_description');

            $table->integer('worker_paid');

            $table->integer('last_debt');
            $table->integer('paid');

            $table->boolean('is_saved')->default(0);


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
        Schema::dropIfExists('factors');
    }
}
