<?php

namespace App\Http\Controllers;

use Domain\Test\ValueObject\Username;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\Password;
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

    public function play()
    {
        $users = $this->app->make('App\Projections\Users\Projector');
        $users->play();
    }

    public function create(Request $request)
    {
        $log = $this->app->make('BoundedContext\Contracts\Log');
        $log->reset();

        $aggregate_collections = $this->app->make('BoundedContext\Projector\AggregateCollections');
        $aggregate_collections->projection()->reset();

        $active_usernames = $this->app->make('Domain\Test\Projection\ActiveUsernames\Projector');
        $active_usernames->projection()->reset();

        $active_emails = $this->app->make('Domain\Test\Projection\ActiveEmails\Projector');
        $active_emails->projection()->reset();

        $users = $this->app->make('App\Projections\Users\Projector');
        $users->projection()->reset();

        $this->bus->dispatch(new Command\Create(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new Username('lyonscf'),
            new EmailAddress('colin@tercet.io'),
            new Password('password')
        ));

        $this->bus->dispatch(new Command\Create(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f7'),
            new Username('bphilson2'),
            new EmailAddress('bphilson1@gmail.com'),
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

        $users->play();

        dd($this->app->make('BoundedContext\Contracts\Log'));
    }
}