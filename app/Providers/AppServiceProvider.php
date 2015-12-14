<?php

namespace App\Providers;

use BoundedContext\Laravel\Generator\Uuid;
use BoundedContext\Laravel\Illuminate\Log;
use BoundedContext\Laravel\Item\Upgrader;
use BoundedContext\Map\Map;
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
        $this->app->singleton('EventLog', function($app)
        {
            return new Log(
                new Upgrader(
                    new Map(
                        Config::get('bounded-context.events'),
                        $this->app->make('BoundedContext\Contracts\Generator\Uuid')
                    ),
                    $this->app->make('BoundedContext\Contracts\Generator\Uuid')
                ),
                $this->app->make('db'),
                'event_log',
                'event_stream'
            );
        });

        $this->app->singleton('CommandLog', function($app)
        {
            return new Log(
                new Upgrader(
                    new Map(
                        Config::get('bounded-context.commands'),
                        $this->app->make('BoundedContext\Contracts\Generator\Uuid')
                    ),
                    $this->app->make('BoundedContext\Contracts\Generator\Uuid')
                ),
                $this->app->make('db'),
                'command_log',
                'command_stream'
            );
        });
    }
}
