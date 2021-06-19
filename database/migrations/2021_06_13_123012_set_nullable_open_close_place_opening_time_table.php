<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNullableOpenClosePlaceOpeningTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('place_opening_time', function (Blueprint $table) {
            $table->dateTime('open')->nullable()->change();
            $table->dateTime('close')->nullable()->change();
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
            $table->dateTime('open')->change();
            $table->dateTime('close')->change();
        });
    }
}
