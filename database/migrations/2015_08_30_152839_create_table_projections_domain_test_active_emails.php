<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectionsDomainTestActiveEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projections_domain_test_active_emails', function (Blueprint $table) {
            $table->string('user_id', 36)->unique();
            $table->string('email', 128)->unique();
        });

        DB::table('player_snapshots')->insert([
            'name' => 'Domain\Test\Projection\Invariant\EmailAddressMustBeUnique\Projection\Projector'
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
            ->where('name', 'Domain\Test\Projection\Invariant\EmailAddressMustBeUnique\Projection\Projector')
            ->delete();

        Schema::drop('projections_domain_test_active_emails');
    }
}
