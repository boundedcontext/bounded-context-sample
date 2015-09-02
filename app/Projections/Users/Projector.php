<?php namespace App\Projections\Users;

use BoundedContext\Log\Item;
use Domain\Test\Aggregate\User\Event;
use BoundedContext\Projector\AbstractProjector;

class Projector extends AbstractProjector
{
    protected function when_test_user_created(Event\Created $event, Projection $projection, Item $item)
    {
        $projection->create(
            $event->id(),
            $item->occurred_at(),
            $event->username,
            $event->email,
            $event->password
        );
    }

    protected function when_test_user_username_changed(Event\UsernameChanged $event, Projection $projection, Item $item)
    {
        $projection->change_username(
            $event->id(),
            $item->occurred_at(),
            $event->new_username
        );
    }

    protected function when_test_user_deleted(Event\Deleted $event, Projection $projection, Item $item)
    {
        $projection->delete(
            $event->id(),
            $item->occurred_at()
        );
    }
}
