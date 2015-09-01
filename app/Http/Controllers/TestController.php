<?php

namespace App\Http\Controllers;

use BoundedContext\Laravel\Illuminate\Projector\Repository;
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

        $repository = new Repository($this->app);

        $aggregate_collections = $repository->get('BoundedContext\Projection\AggregateCollections\Projector');
        $aggregate_collections->reset();
        $repository->save($aggregate_collections);

        $active_usernames = $repository->get('Domain\Test\Projection\ActiveUsernames\Projector');
        $active_usernames->reset();
        $repository->save($active_usernames);

        $active_emails = $repository->get('Domain\Test\Projection\ActiveEmails\Projector');
        $active_emails->reset();
        $repository->save($active_emails);

        $users = $repository->get('App\Projections\Users\Projector');
        $users->reset();
        $repository->save($users);

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
        $repository->save($users);

        $greeting_workflow = $this->app->make('App\Workflows\Greeting');
        $greeting_workflow->reset();
        $greeting_workflow->play();

        dd($this->app->make('BoundedContext\Contracts\Log'));
    }
}