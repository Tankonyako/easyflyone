<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('firstname');
            $table->string('lastname');
            $table->string('photo');
            $table->string('passportCountry');
            $table->string('passportID');
            $table->string('passportExpireDate')->nullable();
            $table->integer('seatPosX');
            $table->integer('seatPosY');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}
