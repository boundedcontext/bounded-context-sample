<?php

namespace Domain\Test\Projection\ActiveUsernames;

use BoundedContext\Projector\AbstractProjector;
use Domain\Test\Aggregate\User\Event;

class Projector extends AbstractProjector
{
    protected function when_test_user_created(Event\Created $event, Projection $projection)
    {
        $projection->add($event->id(), $event->username);
    }

    protected function when_test_user_username_changed(Event\UsernameChanged $event, Projection $projection)
    {
        $projection->replace($event->id(), $event->old_username, $event->new_username);
    }

    protected function when_test_user_deleted(Event\Deleted $event, Projection $projection)
    {
        $projection->remove($event->id());
    }
}
