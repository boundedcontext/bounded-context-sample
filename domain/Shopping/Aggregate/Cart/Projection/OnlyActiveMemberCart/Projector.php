<?php namespace Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart;

use BoundedContext\Projection\AbstractProjector;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

use Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart\Projection;
use Domain\Shopping\Aggregate\Cart\Event;


class Projector extends AbstractProjector
{
    protected function when_shopping_cart_created(
        Projection $projection,
        Event\Created $event,
        Snapshot $snapshot
    )
    {
        $projection->create($event->cart);
    }

    protected function when_shopping_cart_checked_out(
        Projection $projection,
        Event\CheckedOut $event,
        Snapshot $snapshot
    )
    {
        $projection->checkout($event->id());
    }
}
