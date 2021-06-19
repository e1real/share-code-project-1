<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLatLonInPlaceMapDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('place_map_data', function (Blueprint $table) {
            $table->float('lat', 8, 4)->change();
            $table->float('lon', 8, 4)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('place_map_data', function (Blueprint $table) {
            $table->float('lat')->change();
            $table->float('lon')->change();
        });
    }
}
