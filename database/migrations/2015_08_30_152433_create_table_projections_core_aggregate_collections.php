<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectionsCoreAggregateCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projections_core_aggregate_collections', function (Blueprint $table) {
            $table->integer('event_log_id')->unique();
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
        Schema::drop('projections_core_aggregate_collections');
    }
}
