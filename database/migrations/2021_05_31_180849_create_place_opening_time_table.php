<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceOpeningTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_opening_time', function (Blueprint $table) {
            $table->id('place_opening_time_id');
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')
                ->references('place_id')
                ->on('places');
            $table->dateTime('open');
            $table->dateTime('close');
            $table->boolean('is_closed')->default(0);
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
        Schema::dropIfExists('place_opening_time');
    }
}
