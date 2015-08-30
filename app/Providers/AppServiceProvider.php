<?php

namespace App\Providers;

use BoundedContext\Laravel\Illuminate\Log;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('BoundedContext\Contracts\Log', function($app)
        {
            return new Log(
                $this->app->make('BoundedContext\Laravel\Item\Upgrader'),
                $this->app->make('db'),
                'event_log'
            );
        });
    }
}
