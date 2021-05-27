<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewFlightsTable extends Migration
{
    public function up()
    {
        Schema::create('new_flights', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('image')->default(null)->nullable();
            $table->string('name');
            $table->string('description')->default(null)->nullable();
            $table->string('originIata');
            $table->string('destinationIata');

            $table->integer('createdById');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('new_flights');
    }
}
