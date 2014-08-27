<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        // start with a blank database
        DB::table('songs')->truncate();
        DB::table('users')->truncate();

        // deploy the seeders!
		$this->call('UsersSeeder');
	}

}
