<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('uid');
            $table->integer('createdbyid');
            $table->timestamp('generatedDate');
            $table->json('passengers');
            $table->string('passengersLimit');
            $table->timestamp('departureDate');
            $table->timestamp('returnDate');
            $table->boolean('willReturn');
            $table->string('originIataCode');
            $table->string('destinationIataCode');
            $table->string('airwayid');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
