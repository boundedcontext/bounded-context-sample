<?php namespace App\Projections\Users;

use BoundedContext\Contracts\Log;
use BoundedContext\Log\Item;
use BoundedContext\Projector\AbstractProjector;

class Projector extends AbstractProjector
{
    public function __construct(Log $log, Projection $projection)
    {
        parent::__construct($log, $projection);
    }

    protected function when_test_user_created(Projection $projection, Item $item)
    {
        $event = $item->event();

        $projection->create(
            $event->id(),
            $item->occurred_at(),
            $event->username,
            $event->password,
            $event->email
        );
    }

    protected function when_test_user_username_changed(Projection $projection, Item $item)
    {
        $event = $item->event();

        $projection->change_username(
            $event->id(),
            $item->occurred_at(),
            $event->new_username
        );
    }

    protected function when_test_user_deleted(Projection $projection, Item $item)
    {
        $event = $item->event();

        $projection->delete(
            $event->id(),
            $item->occurred_at()
        );
    }
}
