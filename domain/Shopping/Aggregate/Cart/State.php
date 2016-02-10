<?php namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Sourced\Aggregate\State\AbstractState;

class State extends AbstractState implements \BoundedContext\Contracts\Sourced\Aggregate\State\State
{
    protected function when_shopping_cart_created(
        Projection $projection,
        Event\Created $event
    )
    {
        $projection->create(
            $event->cart
        );
    }

    protected function when_shopping_cart_product_added(
        Projection $projection,
        Event\ProductAdded $event
    )
    {
        $projection->add_product(
            $event->product
        );
    }

    protected function when_shopping_cart_product_quantity_changed(
        Projection $projection,
        Event\ProductQuantityChanged $event
    )
    {
        $projection->change_product_quantity(
            $event->product
        );
    }

    protected function when_shopping_cart_product_removed(
        Projection $projection,
        Event\ProductRemoved $event
    )
    {
        $projection->remove_product(
            $event->product_id
        );
    }

    protected function when_shopping_cart_checked_out(
        Projection $projection,
        Event\CheckedOut $event
    )
    {
        $projection->checkout();
    }
}
