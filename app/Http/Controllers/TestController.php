<?php namespace App\Http\Controllers;

use BoundedContext\Contracts\Bus\Dispatcher;
use BoundedContext\Laravel\Illuminate\Projector;
use BoundedContext\Laravel\Illuminate\Workflow;
use Domain\Test\Entity\User;
use Domain\Test\ValueObject\Username;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\Password;
use Domain\Test\Aggregate\User\Command;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

use BoundedContext\Laravel\ValueObject\Uuid;

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
        // Reset Event Log/Stream
        $log = $this->app->make('BoundedContext\Contracts\Event\Log');
        $log->reset();

        // Reset Command Log/Stream
        $log = $this->app->make('BoundedContext\Contracts\Command\Log');
        $log->reset();

        // Reset all Players (Projections and Workflows)
        // $this->players->all()->play();
        // $this->players->id('b98540d7-c3f9-4af3-8d77-e46662fcb3f6')->play();
        // $this->players->domain()->projectors()->play();
        // $this->players->application()->workflows()->play();

        /*
            // Reset all Projections
            $projection_player = new Projector\Player($this->app);
            $projection_player->reset();

            // Reset all Workflows
            $player = new Workflow\Player($this->app);
            $player->reset();
        */

        $this->bus->dispatch(new Command\Create(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new User(
                new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
                new Username('lyonscf'),
                new EmailAddress('colin@tercet.io'),
                (new Password('password'))->encrypt()
            )
        ));

        $this->bus->dispatch(new Command\Create(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f7'),
            new User(
                new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f7'),
                new Username('bphilson2'),
                new EmailAddress('bphilson1@gmail.com'),
                (new Password('roflcopter'))->encrypt()
            )
        ));

        $this->bus->dispatch(new Command\ChangeUsername(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new Username('lyonscf2')
        ));

        $this->bus->dispatch(new Command\ChangeUsername(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new Username('lyonscf3')
        ));

        /*
        $this->bus->dispatch(new Command\Delete(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6')
        ));
        */

        // Play Application Workflows
        $player = new Workflow\Player($this->app, 'app');
        $player->play();

        // Play Application Projectors
        $projection_player = new Projector\Player($this->app, 'app');
        $projection_player->play();

        dd($this->app->make('BoundedContext\Contracts\Event\Log'));
    }
}
