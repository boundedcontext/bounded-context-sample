<?php namespace Domain\Test\Invariant\UsernameMustBeUnique\Projection;

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
            $event->username
        );
    }

    protected function when_test_user_username_changed(
        Projection $projection,
        Event\UsernameChanged $event
    )
    {
        $projection->replace(
            $event->id(),
            $event->old_username,
            $event->new_username
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
