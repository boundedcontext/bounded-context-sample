<?php

namespace App\Providers;

use BoundedContext\Map\Map;
use Infrastructure\Log;

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
            'Infrastructure\Dispatcher'
        );

        $this->app->singleton('BoundedContext\Contracts\Log', function($app)
        {
            return new Log(
                new Map(Config::get('events')),
                new \BoundedContext\Collection\Collection([
                    new \BoundedContext\Log\Item(
                        new \BoundedContext\ValueObject\Uuid('f0c4d179-6f25-4171-a9d4-66ea943a349e'),
                        new \BoundedContext\ValueObject\Uuid('cfd9ef79-2cf3-4ee6-805f-619f72352921'),
                        \BoundedContext\ValueObject\DateTime::now(),
                        new \BoundedContext\ValueObject\Version(1),
                        new \Domain\Test\Aggregate\User\Event\Created(
                            new \BoundedContext\ValueObject\Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
                            new \Domain\Test\ValueObject\Username('lyonscf'),
                            new \Domain\Test\ValueObject\EmailAddress('colin@tercet.io'),
                            new \Domain\Test\ValueObject\EncryptedPassword('drowssap')
                        )
                    ),
                    new \BoundedContext\Log\Item(
                        new \BoundedContext\ValueObject\Uuid('5007db80-3d4b-49fe-afd6-68e7fe5a482f'),
                        new \BoundedContext\ValueObject\Uuid('cfd9ef79-2cf3-4ee6-805f-619f72352921'),
                        \BoundedContext\ValueObject\DateTime::now(),
                        new \BoundedContext\ValueObject\Version(1),
                        new \Domain\Test\Aggregate\User\Event\Created(
                            new \BoundedContext\ValueObject\Uuid('64cbea01-f61b-4135-b7e1-29b486acc7f1'),
                            new \Domain\Test\ValueObject\Username('other'),
                            new \Domain\Test\ValueObject\EmailAddress('colin1@tercet.io'),
                            new \Domain\Test\ValueObject\EncryptedPassword('drowssap')
                        )
                    ),
                    new \BoundedContext\Log\Item(
                        new \BoundedContext\ValueObject\Uuid('1512abff-e79e-4eed-af88-69c4941bd9a6'),
                        new \BoundedContext\ValueObject\Uuid('cfd9ef79-2cf3-4ee6-805f-619f72352921'),
                        \BoundedContext\ValueObject\DateTime::now(),
                        new \BoundedContext\ValueObject\Version(1),
                        new \Domain\Test\Aggregate\User\Event\Created(
                            new \BoundedContext\ValueObject\Uuid('bf307a89-9727-4bdb-96e2-daabee7f7f6a'),
                            new \Domain\Test\ValueObject\Username('another'),
                            new \Domain\Test\ValueObject\EmailAddress('colin2@tercet.io'),
                            new \Domain\Test\ValueObject\EncryptedPassword('drowssap')
                        )
                    ),
                    new \BoundedContext\Log\Item(
                        new \BoundedContext\ValueObject\Uuid('1bef97c8-4415-49aa-b285-6048ce9dc467'),
                        new \BoundedContext\ValueObject\Uuid('a55e6792-1136-4f79-b6dd-021238e9b615'),
                        \BoundedContext\ValueObject\DateTime::now(),
                        new \BoundedContext\ValueObject\Version(1),
                        new \Domain\Test\Aggregate\User\Event\UsernameChanged(
                            new \BoundedContext\ValueObject\Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
                            new \Domain\Test\ValueObject\Username('lyonscf'),
                            new \Domain\Test\ValueObject\Username('lyonscf1')
                        )
                    )
                ])
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

        $this->app->bind(
            'Domain\Test\Projection\ActiveUsernames\Projection',
            'Infrastructure\Projection\ActiveUsernames'
        );

        $this->app->singleton('Domain\Test\Projection\ActiveUsernames\Projector', function($app)
        {
            $projector = new \Domain\Test\Projection\ActiveUsernames\Projector(
                $this->app->make('BoundedContext\Contracts\Log'),
                $this->app->make('Domain\Test\Projection\ActiveUsernames\Projection')
            );

            $projector->play();

            return $projector;
        });

        $this->app->bind(
            'Domain\Test\Projection\ActiveEmails\Projection',
            'Infrastructure\Projection\ActiveEmails'
        );

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
