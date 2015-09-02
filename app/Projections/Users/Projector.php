<?php namespace App\Projections\Users;

use BoundedContext\Log\Item;
use BoundedContext\Projector\AbstractProjector;

class Projector extends AbstractProjector
{
    protected function when_test_user_created(Projection $projection, Item $item)
    {
        $event = $item->payload();

        $projection->create(
            $event->id(),
            $item->occurred_at(),
            $event->username,
            $event->email,
            $event->password
        );
    }

    protected function when_test_user_username_changed(Projection $projection, Item $item)
    {
        $event = $item->payload();

        $projection->change_username(
            $event->id(),
            $item->occurred_at(),
            $event->new_username
        );
    }

    protected function when_test_user_deleted(Projection $projection, Item $item)
    {
        $event = $item->payload();

        $projection->delete(
            $event->id(),
            $item->occurred_at()
        );
    }
}
