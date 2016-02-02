<?php namespace Domain\Shopping\Aggregate\Cart;

class Aggregate
{
    protected function handle_create(
        State $state,
        Command\Create $command
    )
    {
        $this->assert->not(Invariant\Created::class);

        /* This Invariant uses a Projection */
        $this->assert->is(Invariant\OnlyActiveMemberCart::class,
            [$command->cart->member_id()]
        );

        $state->apply(new Event\Created(
            $command->id(),
            $command->cart
        ));
    }

    protected function handle_add_product_to_cart(
        State $state,
        Command\AddProductToCart $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);
        $this->assert->not(Invariant\Full::class);
        $this->assert->not(Invariant\ExistingProduct::class,
            [$command->product_id]
        );

        $state->apply(new Event\ProductAddedToCart(
            $command->id(),
            $command->product
        ));
    }

    protected function handle_change_product_quantity(
        State $state,
        Command\ChangeProductQuantity $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);
        $this->assert->is(Invariant\ExistingProduct::class,
            [$command->product_id]
        );

        $state->apply(new Event\ProductQuantityChanged(
            $command->id(),
            $command->product_id,
            $command->quantity
        ));
    }

    protected function handle_remove_product_from_cart(
        State $state,
        Command\RemoveProductFromCart $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);
        $this->assert->not(Invariant\Emptied::class);
        $this->assert->is(Invariant\ExistingProduct::class,
            [$command->product_id]
        );

        $state->apply(new Event\ProductRemovedFromCart(
            $command->id(),
            $command->product_id
        ));
    }

    protected function handle_checkout(
        State $state,
        Command\Checkout $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);

        $state->apply(new Event\CheckedOut(
            $command->id()
        ));
    }
}
