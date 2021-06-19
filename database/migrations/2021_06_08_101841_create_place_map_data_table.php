<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceMapDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_map_data', function (Blueprint $table) {
            $table->id('place_map_data_id');
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')
                ->references('place_id')
                ->on('places');
            $table->string('address', 512);
            $table->float('lat');
            $table->float('lon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_map_data');
    }
}
