<?php namespace App\Projections\Users;

use BoundedContext\Contracts\Event\Snapshot\Snapshot;
use BoundedContext\Projection\AbstractProjector;
use Domain\Test\Aggregate\User\Event;

class Projector extends AbstractProjector
{
    protected function when_test_user_created(
        Projection $projection,
        Event\Created $event,
        Snapshot $snapshot
    )
    {
        $projection->create(
            $event->id(),
            $snapshot->occurred_at(),
            $event->username,
            $event->email,
            $event->password
        );
    }

    protected function when_test_user_username_changed(
        Projection $projection,
        Event\UsernameChanged $event,
        Snapshot $snapshot
    )
    {
        $projection->change_username(
            $event->id(),
            $snapshot->occurred_at(),
            $event->new_username
        );
    }

    protected function when_test_user_deleted(
        Projection $projection,
        Event\Deleted $event,
        Snapshot $snapshot
    )
    {
        $projection->delete(
            $event->id(),
            $snapshot->occurred_at()
        );
    }
}
