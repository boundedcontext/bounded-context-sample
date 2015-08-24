<?php

namespace App\Http\Controllers;

use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\Password;
use Domain\Test\ValueObject\Username;
use Domain\Test\Aggregate\User\Command;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;

use BoundedContext\ValueObject\Uuid;

class TestController extends Controller
{
    protected $bus;
    protected $app;

    public function __construct(Dispatcher $bus, Application $app)
    {
        $this->bus = $bus;
        $this->app = $app;
    }

    public function create(Request $request)
    {
        $this->bus->dispatch(new Command\Create(
            Uuid::generate(),
            new Username('bphilson'),
            new EmailAddress('bphilson@gmail.com'),
            new Password('roflcopter')
        ));

        $this->bus->dispatch(new Command\ChangeUsername(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new Username('lyonscf2')
        ));

        $this->bus->dispatch(new Command\ChangeUsername(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new Username('lyonscf3')
        ));

        $this->bus->dispatch(new Command\Delete(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6')
        ));

        echo "<pre>";

        $aggregate_collections = $this->app->make('BoundedContext\Contracts\Projection\AggregateCollections\Projector');
        echo "\nAggregateCollections: " .
            $aggregate_collections->projection()->version() .
            " of " .
            $aggregate_collections->projection()->count()
        ;

        $active_usernames = $this->app->make('Domain\Test\Projection\ActiveUsernames\Projector');
        echo "\nActiveUsernames: " .
            $active_usernames->projection()->version() .
            " of " .
            $active_usernames->projection()->count()
        ;

        $active_emails = $this->app->make('Domain\Test\Projection\ActiveEmails\Projector');
        echo "\nActiveEmails: " .
            $active_emails->projection()->version() .
            " of " .
            $active_emails->projection()->count()
        ;
        echo "</pre>";

        $projector = $this->app->make('App\Projections\Users\Projector');
        $projector->play();
        dd($projector);

        dd($this->app->make('BoundedContext\Contracts\Log'));
    }
}