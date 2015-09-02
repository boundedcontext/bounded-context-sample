<?php namespace App\Workflows;

use BoundedContext\Contracts\Item;
use BoundedContext\Contracts\Workflow;
use BoundedContext\Workflow\AbstractWorkflow;

class Greeting extends AbstractWorkflow implements Workflow
{
    protected function when_test_user_created(Item $item)
    {
        $event = $item->payload();
        var_dump("Hello there ".$event->username->serialize()."!");
    }
}
