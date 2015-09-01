<?php

namespace App\Http\Controllers;

use BoundedContext\Laravel\Illuminate\Projector;
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

    public function create(Request $request)
    {
        // Reset Log/Stream
        $log = $this->app->make('BoundedContext\Contracts\Log');
        $log->reset();

        // Reset all Projections
        $player = new Projector\Player($this->app);
        $player->reset();

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

        // Play Application Projectors
        $player = new Projector\Player($this->app, 'app');
        $player->play();

        $greeting_workflow = $this->app->make('App\Workflows\Greeting');
        $greeting_workflow->reset();
        $greeting_workflow->play();

        dd($this->app->make('BoundedContext\Contracts\Log'));
    }
}