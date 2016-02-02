<?php namespace Domain\Shopping\Aggregate\Cart;

class State
{
    protected function when_shopping_cart_created(
        Model $model,
        Flow $flow,
        Event\Created $event
    )
    {
        $model->create($event->cart);
        $flow->created();
    }

    protected function when_shopping_cart_product_added_to_cart(
        Model $model,
        Flow $flow,
        Event\ProductAddedToCart $event
    )
    {
        $model->add_product($event->product);
    }

    protected function when_shopping_cart_product_quantity_changed(
        Flow $flow,
        Model $model,
        Event\ProductQuantityChanged $event
    )
    {
        $model->change_product_quantity($event->product_id, $event->quantity);
    }

    protected function when_shopping_cart_product_removed_from_cart(
        Flow $flow,
        Model $model,
        Event\ProductQuantityChanged $event
    )
    {
        $flow->not_full();
        $model->remove_product($event->product_id);
    }

    protected function when_shopping_cart_checked_out(
        Flow $flow,
        Model $model,
        Event\CheckedOut $event
    )
    {
        $this->assert(IsNotCheckedOut\Invariant::class);

        $flow->checked_out();
    }
}
