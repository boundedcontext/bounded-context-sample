<?php

namespace App\BoundedContext\Test\Projection\ActiveUsernames;

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

        $projection->add($event->id(), $event->username);
    }

    protected function when_test_user_username_changed(Projection $projection, Item $item)
    {
        $event = $item->event();

        $projection->replace($event->id(), $event->old_username, $event->new_username);
    }

    protected function when_test_user_deleted(Projection $projection, Item $item)
    {
        $event = $item->event();

        $projection->remove($event->id());
    }
}
