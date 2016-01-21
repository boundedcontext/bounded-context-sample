<?php namespace App\Http\Controllers;

use BoundedContext\Contracts\Bus\Dispatcher;
use BoundedContext\Contracts\Generator\Identifier;
use Domain\Test\ValueObject\Username;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\Password;
use Domain\Test\Aggregate\User\Command;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $bus;
    protected $identifier_generator;

    public function __construct(Dispatcher $bus, Identifier $identifier_generator)
    {
        $this->bus = $bus;
        $this->identifier_generator = $identifier_generator;
    }

    public function create(Request $request)
    {
        $this->bus->dispatch(new Command\Create(
            $this->identifier_generator->generate(),
            new Username($request->get('username')),
            new EmailAddress($request->get('email')),
            new Password($request->get('password'))
        ));

        echo "User ".$request->get('username')." was successfully created!";
    }
}
