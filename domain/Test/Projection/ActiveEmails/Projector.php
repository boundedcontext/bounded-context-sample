<?php

namespace Domain\Test\Projection\ActiveEmails;

use Domain\Test\Aggregate\User\Event;
use BoundedContext\Projector\AbstractProjector;

class Projector extends AbstractProjector
{
    protected function when_test_user_created(Event\Created $event, Projection $projection)
    {
        $projection->add(
            $event->id(),
            $event->email
        );
    }

    protected function when_test_user_deleted(Event\Deleted $event, Projection $projection)
    {
        $projection->remove($event->id());
    }
}
