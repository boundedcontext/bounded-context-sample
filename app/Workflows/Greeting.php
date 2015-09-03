<?php namespace App\Workflows;

use BoundedContext\Contracts\Workflow;
use BoundedContext\Workflow\AbstractWorkflow;
use Domain\Test\Aggregate\User;
use Domain\Test\ValueObject\Username;

class Greeting extends AbstractWorkflow implements Workflow
{
    protected function when_test_user_created(User\Event\Created $event)
    {
        $this->bus->dispatch(new User\Command\ChangeUsername(
            $event->id(),
            new Username($event->username->serialize() . 'extra')
        ));
    }
}
