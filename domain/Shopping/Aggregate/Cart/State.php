<?php namespace Domain\Shopping\Aggregate\Cart;

class State implements \BoundedContext\Contracts\Sourced\Aggregate\State\State
{
    protected function when_shopping_cart_created(
        Projection $projection,
        Event\Created $event
    )
    {
        $projection->create($event->cart);
    }

    protected function when_shopping_cart_product_added_to_cart(
        Projection $projection,
        Event\ProductAdded $event
    )
    {
        $projection->add_product($event->product);
    }

    protected function when_shopping_cart_product_quantity_changed(
        Projection $projection,
        Event\ProductQuantityChanged $event
    )
    {
        $projection->change_product_quantity(
            $event->product_id,
            $event->quantity
        );
    }

    protected function when_shopping_cart_product_removed_from_cart(
        Projection $projection,
        Event\ProductQuantityChanged $event
    )
    {
        $projection->remove_product($event->product_id);
    }

    protected function when_shopping_cart_checked_out(
        Projection $projection,
        Event\CheckedOut $event
    )
    {
        $projection->checkout();
    }

    protected function when_shopping_cart_emptied(
        Projection $projection,
        Event\Emptied $event
    )
    {
        /* We don't care, it doesn't effect the state */
    }

    protected function when_shopping_cart_full(
        Projection $projection,
        Event\Full $event
    )
    {
        /* We don't care, it doesn't effect the state */
    }
}
