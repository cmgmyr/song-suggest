<?php
namespace Ss\Repositories;

use Ss\Models\User;
use Ss\Repositories\User\EloquentUser;
use Illuminate\Support\ServiceProvider;

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
            'Ss\Repositories\User\UserInterface',
            function () {
                $model = new EloquentUser(
                    new User
                );

                return $model;
            }
        );
    }
}