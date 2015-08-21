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

        //dd($this->app->make('BoundedContext\Contracts\Log'));
        //dd($this->app->make('BoundedContext\Contracts\Projection\AggregateCollections\Projector'));
        //dd($this->app->make('Domain\Test\Projection\ActiveUsernames\Projector'));
        dd($this->app->make('Domain\Test\Projection\ActiveEmails\Projector'));
    }
}