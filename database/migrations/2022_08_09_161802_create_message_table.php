<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('family_id');
            $table->string('user_name');
            $table->text('message');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')
                ->onDelete('cascade');

            $table->foreign('family_id')->on('families')->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}
