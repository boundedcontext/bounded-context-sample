<?php namespace App\Workflows;

use BoundedContext\Contracts\Workflow;
use BoundedContext\Laravel\Illuminate\Workflow\AbstractWorkflow;

class Greeting extends AbstractWorkflow implements Workflow
{
    protected function when_test_user_created(Item $item)
    {
        $event = $item->event();
        var_dump("Hello there ".$event->username->serialize()."!");
    }
}