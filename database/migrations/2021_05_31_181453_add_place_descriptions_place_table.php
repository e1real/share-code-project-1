<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlaceDescriptionsPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->string('description', 1024)
                ->nullable()
                ->after('name_ge');
            $table->string('description_ge', 1024)
                ->nullable()
                ->after('description');
            $table->string('description_sk', 1024)
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
            $table->dropColumn('description');
            $table->dropColumn('description_ge');
            $table->dropColumn('description_sk');
        });
    }
}
