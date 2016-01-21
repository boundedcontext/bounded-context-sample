<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectionsAppUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projections_app_users', function (Blueprint $table) {
            $table->string('id', 36)->unique();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();
            $table->string('username', 128);
            $table->string('email', 128);
            $table->string('password', 128);
        });

        DB::table('player_snapshots')->insert([
            'name' => 'App\Projections\Users\Projector'
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
            ->where('name', 'App\Projections\Users\Projector')
            ->delete();

        Schema::drop('projections_app_users');
    }
}
