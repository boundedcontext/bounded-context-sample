<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectionsDomainTestActiveUsernames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projections_domain_test_active_usernames', function (Blueprint $table) {
            $table->string('user_id', 36)->unique();
            $table->string('username', 128)->unique();
        });

        DB::table('player_snapshots')->insert([
            'name' => 'Domain\Test\Projection\Invariant\UsernameMustBeUnique\Projection\Projector'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('player_snapshots')
            ->where('name', 'Domain\Test\Projection\Invariant\UsernameMustBeUnique\Projection\Projector')
            ->delete();

        Schema::drop('projections_domain_test_active_usernames');
    }
}
