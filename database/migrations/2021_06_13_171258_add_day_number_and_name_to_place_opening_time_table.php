<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDayNumberAndNameToPlaceOpeningTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('place_opening_time', function (Blueprint $table) {
            $table->string('day_name');
            $table->smallInteger('day_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('place_opening_time', function (Blueprint $table) {
            $table->dropColumn('day_name');
            $table->dropColumn('day_number');
        });
    }
}
