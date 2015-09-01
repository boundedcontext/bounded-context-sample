<?php

namespace Domain\Test\Projection\ActiveEmails;

use BoundedContext\Log\Item;
use BoundedContext\Projector\AbstractProjector;

class Projector extends AbstractProjector
{
    protected function when_test_user_created(Projection $projection, Item $item)
    {
        $event = $item->event();

        $projection->add($event->id(), $event->email);
    }

    protected function when_test_user_deleted(Projection $projection, Item $item)
    {
        $event = $item->event();

        $projection->remove($event->id());
    }
}
