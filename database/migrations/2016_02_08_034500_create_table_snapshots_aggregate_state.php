<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSnapshotsAggregateState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapshots_aggregate_state', function (Blueprint $table) {
            $table->string('id', 36)->unique();
            $table->dateTimeTz('occurred_at');
            $table->integer('version')->default(0);
            $table->text('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('snapshots_aggregate_state');
    }
}
