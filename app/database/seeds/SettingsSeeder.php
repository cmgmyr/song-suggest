<?php

use Ss\Repositories\Setting\Setting;
use Ss\Repositories\User\User;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        // Get the count of current users
        $usersCount = User::count();

        if ($usersCount == 1) {
            $threshold = 1;
        } else {
            $threshold = ceil($usersCount / 2); // majority vote
        }

        Setting::create(
            [
                'key' => 'threshold',
                'value' => $threshold
            ]
        );

        Setting::create(
            [
                'key' => 'vote_reminder_days',
                'value' => 3
            ]
        );
    }
}
