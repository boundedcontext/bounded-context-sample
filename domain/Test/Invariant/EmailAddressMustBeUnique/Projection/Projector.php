<?php namespace Domain\Test\Invariant\EmailAddressMustBeUnique\Projection;

use BoundedContext\Projection\AbstractProjector;
use Domain\Test\Aggregate\User\Event;

class Projector extends AbstractProjector
{
    protected function when_test_user_created(
        Projection $projection,
        Event\Created $event
    )
    {
        $projection->add(
            $event->id(),
            $event->email
        );
    }

    protected function when_test_user_deleted(
        Projection $projection,
        Event\Deleted $event
    )
    {
        $projection->remove(
            $event->id()
        );
    }
}
