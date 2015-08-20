<?php

namespace Domain\Test\Projection\ActiveEmails;

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

        $projection->add($event->id(), $event->email);
    }

    protected function when_test_user_deleted(Projection $projection, Item $item)
    {
        $event = $item->event();

        $projection->remove($event->id());
    }
}
