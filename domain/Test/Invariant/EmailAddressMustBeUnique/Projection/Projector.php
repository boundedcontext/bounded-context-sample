<?php namespace Domain\Test\Projection\Invariant\EmailAddressMustBeUnique\Projection;

use Domain\Test\Aggregate\User\Event;
use BoundedContext\Projection\AbstractProjector;

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
