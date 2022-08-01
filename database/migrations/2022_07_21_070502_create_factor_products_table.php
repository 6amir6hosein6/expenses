<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factor_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factor_id');
            $table->unsignedBigInteger('safi_id')->nullable();

            $table->integer('product_id');
            $table->string('product_name');

            $table->double('weight');
            $table->integer('count');
            $table->double('fee');

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
        Schema::dropIfExists('factor_products');
    }
}
