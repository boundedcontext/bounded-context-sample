<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEventSnapshotStream extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_snapshot_stream', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('log_id')->unique();
            $table->string('log_snapshot_id', 36)->unique();
            $table->string('aggregate_id', 36);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_snapshot_stream');
    }
}
