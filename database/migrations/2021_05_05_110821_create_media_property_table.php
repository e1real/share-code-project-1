<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_property', function (Blueprint $table) {
            $table->unsignedBigInteger('media_id');
            $table->string('width');
            $table->string('height');
            $table->string('aspect_ratio');
            $table->string('orientation')->default('vertical');
            $table->string('duration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_property');
    }
}
