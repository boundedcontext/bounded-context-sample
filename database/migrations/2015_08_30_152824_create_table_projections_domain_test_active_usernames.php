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

        DB::table('projectors')->insert([
            'name' => 'Domain\Test\Projection\ActiveUsernames\Projector'
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
            ->where('name', 'Domain\Test\Projection\ActiveUsernames\Projector')
            ->delete();

        Schema::drop('projections_domain_test_active_usernames');
    }
}
