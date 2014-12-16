<?php

use Ss\Repositories\User\User;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // create initial admin user
        User::create(
            array(
                'first_name' => 'Chris',
                'last_name'  => 'Gmyr',
                'email'      => 'chris@modomediagroup.com',
                'password'   => 'password123',
                'is_admin'   => 'y',
                'is_active'  => 'y',
            )
        );

        // create 5 more users
        /*foreach (range(1, 5) as $index) {
            User::create(
                array(
                    'first_name' => $faker->firstName,
                    'last_name'  => $faker->lastName,
                    'email'      => $faker->email,
                    'password'   => $faker->word,
                    'is_admin'   => $faker->randomElement(array('y', 'n')),
                    'is_active'  => $faker->randomElement(array('y', 'n')),
                )
            );
        }*/
    }
}
