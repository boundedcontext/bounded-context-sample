<?php namespace App\Workflows;

use BoundedContext\Contracts\Workflow;
use BoundedContext\Workflow\AbstractWorkflow;
use Domain\Test\Aggregate\User;

class Greeting extends AbstractWorkflow implements Workflow
{
    protected function when_test_user_created(User\Event\Created $event)
    {
        var_dump("Hello there ".$event->username->serialize()."!");
    }
}
