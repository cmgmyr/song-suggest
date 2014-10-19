<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIndexesToTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('songs', function(Blueprint $table)
		{
            $table->index('user_id');
		});

        Schema::table('votes', function(Blueprint $table)
        {
            $table->index('user_id');
            $table->index('song_id');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('songs', function(Blueprint $table)
		{
            $table->dropIndex('songs_user_id_index');
		});

        Schema::table('votes', function(Blueprint $table)
        {
            $table->dropIndex('votes_user_id_index');
            $table->dropIndex('votes_song_id_index');
        });
	}

}
