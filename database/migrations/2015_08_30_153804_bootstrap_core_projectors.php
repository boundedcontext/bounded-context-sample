<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BootstrapCoreProjectors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('projectors')->insert([
            'name' => 'BoundedContext\Projection\AggregateCollections\Projector'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('projectors')
            ->where('name', 'BoundedContext\Projection\AggregateCollections\Projector')
            ->delete();
    }
}
