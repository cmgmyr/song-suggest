<?php
namespace Ss\Repositories;

use Ss\Repositories\Activity\Activity;
use Ss\Repositories\Activity\EloquentActivity;
use Ss\Repositories\Song\EloquentSong;
use Ss\Repositories\Song\Song;
use Ss\Repositories\User\EloquentUser;
use Illuminate\Support\ServiceProvider;
use Ss\Repositories\User\User;
use Ss\Repositories\Vote\EloquentVote;
use Ss\Repositories\Vote\Vote;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind(
            'Ss\Repositories\Activity\ActivityInterface',
            function () {
                $model = new EloquentActivity(
                    new Activity
                );

                return $model;
            }
        );

        $app->bind(
            'Ss\Repositories\Song\SongInterface',
            function () {
                $model = new EloquentSong(
                    new Song
                );

                return $model;
            }
        );

        $app->bind(
            'Ss\Repositories\User\UserInterface',
            function () {
                $model = new EloquentUser(
                    new User
                );

                return $model;
            }
        );

        $app->bind(
            'Ss\Repositories\Vote\VoteInterface',
            function () {
                $model = new EloquentVote(
                    new Vote
                );

                return $model;
            }
        );
    }
}