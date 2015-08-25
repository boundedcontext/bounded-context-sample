<?php

namespace App\Providers;

use BoundedContext\Laravel\Log\IlluminateLog;
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
        $this->app->singleton('BoundedContext\Contracts\Map', function($app)
        {
            return new Map(Config::get('events'));
        });

        $this->app->singleton('BoundedContext\Contracts\Log', function($app)
        {
            return new IlluminateLog(
                $this->app->make('BoundedContext\Laravel\Illuminate\Item\Upgrader'),
                DB::connection(),
                'event_log'
            );
        });

        $this->app->bind(
            'BoundedContext\Contracts\Projection\AggregateCollections\Projector',
            'Infrastructure\Core\Projection\AggregateCollections\Projector'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
