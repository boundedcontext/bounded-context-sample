<?php namespace App\Providers;

use BoundedContext\Laravel\Command\Log as CommandLog;
use BoundedContext\Laravel\Event\Log as EventLog;
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
        $this->app->singleton('BoundedContext\Contracts\Event\Log', function($app)
        {
            return new EventLog(
                $this->app->make('BoundedContext\Contracts\Event\Snapshot\Factory'),
                $this->app->make('db'),
                'event_snapshot_log',
                'event_snapshot_stream'
            );
        });

        $this->app->singleton('BoundedContext\Contracts\Command\Log', function($app)
        {
            return new CommandLog(
                $this->app->make('BoundedContext\Contracts\Event\Snapshot\Factory'),
                $this->app->make('db'),
                'command_snapshot_log',
                'command_snapshot_stream'
            );
        });
    }
}
