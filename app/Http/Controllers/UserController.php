<?php namespace App\Http\Controllers;

use BoundedContext\Contracts\Dispatcher;
use Domain\Test\ValueObject\Username;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\Password;
use Domain\Test\Aggregate\User\Command;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

use BoundedContext\ValueObject\Uuid;

class UserController extends Controller
{
    protected $bus;

    public function __construct(Dispatcher $bus)
    {
        $this->bus = $bus;
    }

    public function create(Request $request)
    {
        $this->bus->dispatch(new Command\Create(
            Uuid::generate(),
            new Username($request->get('username')),
            new EmailAddress($request->get('email')),
            new Password($request->get('password'))
        ));

        echo "User ".$request->get('username')." was successfully created!";
    }
}