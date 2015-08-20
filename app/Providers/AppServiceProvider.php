<?php

namespace App\Providers;

use App\Infrastructure\Log;

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
        $this->app->bind(
            'Illuminate\Contracts\Bus\Dispatcher',
            'App\Infrastructure\Dispatcher'
        );

        $this->app->singleton('BoundedContext\Contracts\Log', function($app)
        {
            return new Log(Config::get('event_log'));
        });

        $this->app->singleton('BoundedContext\Contracts\Projection\AggregateCollections\Projector', function($app)
        {
            $projector = new \App\Infrastructure\Projection\AggregateCollections\Projector(
                $app->make('BoundedContext\Contracts\Log'),
                new \App\Infrastructure\Projection\AggregateCollections\Projection()
            );

            $projector->play();

            return $projector;
        });

        $this->app->bind(
            'App\BoundedContext\Test\Projection\ActiveUsernames\Projection',
            'App\Infrastructure\Projection\ActiveUsernames'
        );

        $this->app->singleton('App\BoundedContext\Test\Projection\ActiveUsernames\Projector', function($app)
        {
            $projector = new \App\BoundedContext\Test\Projection\ActiveUsernames\Projector(
                $this->app->make('BoundedContext\Contracts\Log'),
                $this->app->make('App\BoundedContext\Test\Projection\ActiveUsernames\Projection')
            );

            $projector->play();

            return $projector;
        });

        $this->app->bind(
            'App\BoundedContext\Test\Projection\ActiveEmails\Projection',
            'App\Infrastructure\Projection\ActiveEmails'
        );

        $this->app->singleton('App\BoundedContext\Test\Projection\ActiveEmails\Projector', function($app)
        {
            $projector = new \App\BoundedContext\Test\Projection\ActiveEmails\Projector(
                $this->app->make('BoundedContext\Contracts\Log'),
                $this->app->make('App\BoundedContext\Test\Projection\ActiveEmails\Projection')
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
