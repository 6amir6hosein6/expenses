<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('price');
            $table->string('date');
            $table->text('description')->nullable();
            $table->string('for_what')->default('متفرقه');
            $table->string('for_what_sub')->default('متفرقه');
            $table->string('title');
            $table->integer('fee')->nullable();
            $table->string('fee_name')->nullable();

            $table->integer('importance');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('family_id')->on('families')->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
