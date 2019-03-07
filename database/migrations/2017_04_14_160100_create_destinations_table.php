<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('postcode')->nullable()->default(null);
            $table->string('street_address')->nullable()->default(null);
            $table->string('pin_color')->default('black');
            $table->double('lat', 12, 10);
            $table->double('long', 13,10);
            $table->integer('event_id')->unsigned();
            $table->dateTime('date')->nullable()->default(null);;
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinations');
    }
}
