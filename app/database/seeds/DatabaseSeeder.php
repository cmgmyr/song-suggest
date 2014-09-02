<?php

class DatabaseSeeder extends Seeder
{

    /**
     * @var
     */
    protected $environment;

    /**
     * @var array
     */
    protected $tables = [
        'songs',
        'users'
    ];

    /**
     * @var array
     */
    protected $seeders = [
        'UsersSeeder'
    ];

    public function __construct()
    {
        $this->environment = App::environment();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // start with a blank database
        $this->cleanDatabase();

        // deploy the seeders!
        foreach ($this->seeders as $seed) {
            $this->call($seed);
        }
    }

    /**
     * Clean the database for new seeds
     */
    private function cleanDatabase()
    {
        if ($this->environment != 'testing') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }

        if ($this->environment != 'testing') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }

}
