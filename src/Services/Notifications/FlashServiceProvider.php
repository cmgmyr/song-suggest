<?php

namespace Ss\Services\Notifications;

use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('flash', function () {
            return $this->app->make('Ss\Services\Notifications\FlashNotifier');
        });
    }
}
