<?php

namespace App\Providers;

use BoundedContext\Laravel\Log\InMemoryLog;
use BoundedContext\Map\Map;

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
        $this->app->singleton('BoundedContext\Contracts\Log', function($app)
        {
            return new InMemoryLog(
                new Map(Config::get('events')),
                File::get(__DIR__ . '/../../infrastructure/event_log.json')
            );
        });

        $this->app->singleton('BoundedContext\Contracts\Projection\AggregateCollections\Projector', function($app)
        {
            $projector = new \Infrastructure\Projection\AggregateCollections\Projector(
                $app->make('BoundedContext\Contracts\Log'),
                new \Infrastructure\Projection\AggregateCollections\Projection()
            );

            $projector->play();

            return $projector;
        });

        $this->app->singleton('Domain\Test\Projection\ActiveUsernames\Projector', function($app)
        {
            $projector = new \Domain\Test\Projection\ActiveUsernames\Projector(
                $this->app->make('BoundedContext\Contracts\Log'),
                $this->app->make('Domain\Test\Projection\ActiveUsernames\Projection')
            );

            $projector->play();

            return $projector;
        });

        $this->app->singleton('Domain\Test\Projection\ActiveEmails\Projector', function($app)
        {
            $projector = new \Domain\Test\Projection\ActiveEmails\Projector(
                $this->app->make('BoundedContext\Contracts\Log'),
                $this->app->make('Domain\Test\Projection\ActiveEmails\Projection')
            );

            $projector->play();

            return $projector;
        });
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
