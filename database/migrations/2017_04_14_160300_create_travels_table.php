<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->string('city');
            $table->string('postcode');
            $table->string('street_address');
            $table->decimal('lat', 12, 10);
            $table->decimal('long', 13,10);
            $table->boolean('public')->default(true);
            $table->integer('user_id')->unsigned();
            $table->string('phone_number')->nullable();
            $table->integer('destination_id')->unsigned();
            $table->integer('transportation_mean_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('transportation_mean_id')->references('id')->on('transportation_means');
            $table->foreign('destination_id')->references('id')->on('destinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travels');
    }
}
