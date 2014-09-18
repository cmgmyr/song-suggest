<?php
namespace Ss\Repositories;

use Ss\Repositories\Activity\Activity;
use Ss\Repositories\Activity\EloquentActivity;
use Ss\Repositories\Category\Category;
use Ss\Repositories\Category\EloquentCategory;
use Ss\Repositories\Comment\Comment;
use Ss\Repositories\Comment\EloquentComment;
use Ss\Repositories\Follow\EloquentFollow;
use Ss\Repositories\Follow\Follow;
use Ss\Repositories\Setting\EloquentSetting;
use Ss\Repositories\Setting\Setting;
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
            'Ss\Repositories\Category\CategoryInterface',
            function () {
                $model = new EloquentCategory(
                    new Category
                );

                return $model;
            }
        );

        $app->bind(
            'Ss\Repositories\Comment\CommentInterface',
            function () {
                $model = new EloquentComment(
                    new Comment
                );

                return $model;
            }
        );

        $app->bind(
            'Ss\Repositories\Follow\FollowInterface',
            function () {
                $model = new EloquentFollow(
                    new Follow
                );

                return $model;
            }
        );

        $app->bind(
            'Ss\Repositories\Setting\SettingInterface',
            function () {
                $model = new EloquentSetting(
                    new Setting
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