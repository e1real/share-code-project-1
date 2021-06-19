<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreenM2mGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screen_m2m_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('screen_id');
            $table->unsignedBigInteger('screen_group_id');
            $table->foreign('screen_id')
                ->references('screen_id')
                ->on('screens');
            $table->foreign('screen_group_id')
                ->references('screen_group_id')
                ->on('screen_groups');
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
        Schema::dropIfExists('screen_m2m_groups');
    }
}
