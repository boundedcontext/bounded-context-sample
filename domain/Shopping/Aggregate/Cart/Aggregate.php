<?php namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Contracts\Sourced\Aggregate\Aggregate as AggregateContract;
use BoundedContext\Sourced\Aggregate\AbstractAggregate;

class Aggregate extends AbstractAggregate implements AggregateContract
{
    protected function when_shopping_cart_created(
        State $state,
        Event\Created $event
    )
    {
        $this->assert(IsNotCreated\Invariant::class);

        // $flow->create();
        $state->create($event->cart);

        /* If "Empty" is part of the language externally.

        -- I won't write the event handler for it, just assume it's there.

        $this->apply(Event\Empty::class));

        */
    }

    protected function when_shopping_cart_product_added_to_cart(
        State $state,
        Event\ProductAddedToCart $event
    )
    {
        $this->assert(IsFull\Invariant::class);

        $state->add_product($event->product);

        /* If "Full" is part of the language externally.

        -- I won't write the event handler for it, just assume it's there.

        $this->apply(Event\Full::class));

        */
    }

    protected function when_shopping_cart_product_quantity_changed(
        State $state,
        Event\ProductQuantityChanged $event
    )
    {
        /* This could just be a property of the Collection/Index Object for $products. It depends on the language. */
        $this->assert(ProductExists\Invariant::class,
            [$event->product_id]
        );

        $state->change_product_quantity($event->product_id, $event->quantity);
    }

    protected function when_shopping_cart_product_removed_from_cart(
        State $state,
        Event\ProductQuantityChanged $event
    )
    {
        /* This could just be a property of the Collection/Index Object for $products. It depends on the language. */
        $this->assert(ProductExists\Invariant::class,
            [$event->product_id]
        );

        $state->remove_product($event->product_id);
    }

    protected function when_shopping_cart_checked_out(
        State $state,
        Event\CheckedOut $event
    )
    {
        $state->checkout();
    }
}
