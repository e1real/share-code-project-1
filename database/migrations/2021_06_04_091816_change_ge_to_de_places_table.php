<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeGeToDePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('name_ge');
            $table->string('name_de', 1024)
                ->nullable()
                ->after('name');
            $table->dropColumn('description_ge');
            $table->string('description_de', 1024)
                ->nullable()
                ->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->string('name_ge', 1024)
                ->nullable()
                ->after('name');
            $table->dropColumn('name_de');

            $table->string('description_ge', 1024)
                ->nullable()
                ->after('description');
            $table->dropColumn('description_de');
        });
    }
}
