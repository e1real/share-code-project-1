<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('screens', function (Blueprint $table) {
            $table->string('internal_code')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('screen_type_id')->nullable();
            $table->unsignedBigInteger('screen_group_id')->nullable();
            $table->foreign('screen_group_id')
                ->references('screen_group_id')
                ->on('screen_groups');
            $table->string('image_url')->nullable();
            $table->string('image_path')->nullable();
            $table->string('status', 64)->default('offline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('screens', function (Blueprint $table) {
            $table->dropColumn('internal_code');
            $table->dropColumn('description');
            $table->dropColumn('screen_type');
            $table->dropColumn('image_url');
            $table->dropColumn('image_path');
            $table->dropColumn('status');
        });
    }
}
