<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceNewFlightsTable extends Migration
{
    public function up()
    {
        Schema::table('new_flights', function (Blueprint $table) {
            $table->string('price');
        });
    }

    public function down()
    {
        Schema::table('new_flights', function (Blueprint $table) {
            $table->drop('price');
        });
    }
}
