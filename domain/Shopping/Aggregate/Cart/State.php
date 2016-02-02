<?php namespace Domain\Shopping\Aggregate\Cart;

class State
{
    protected function when_shopping_cart_created(
        Model $model,
        Event\Created $event
    )
    {
        $model->create($event->cart);
    }

    protected function when_shopping_cart_product_added_to_cart(
        Model $model,
        Event\ProductAddedToCart $event
    )
    {
        $model->add_product($event->product);
    }

    protected function when_shopping_cart_product_quantity_changed(
        Model $model,
        Event\ProductQuantityChanged $event
    )
    {
        $model->change_product_quantity(
            $event->product_id,
            $event->quantity
        );
    }

    protected function when_shopping_cart_product_removed_from_cart(
        Model $model,
        Event\ProductQuantityChanged $event
    )
    {
        $model->remove_product($event->product_id);
    }

    protected function when_shopping_cart_checked_out(
        Model $model,
        Event\CheckedOut $event
    )
    {
        $model->checkout();
    }
}
