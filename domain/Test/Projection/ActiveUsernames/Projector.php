<?php

namespace Domain\Test\Projection\ActiveUsernames;

use BoundedContext\Log\Item;
use BoundedContext\Projector\AbstractProjector;

class Projector extends AbstractProjector
{
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
