<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCommandSnapshotStream extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_snapshot_stream', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('log_id')->unique();
            $table->string('log_item_id', 36)->unique();
            $table->string('aggregate_id', 36);
            $table->integer('version')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('command_snapshot_stream');
    }
}
