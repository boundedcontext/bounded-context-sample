<?php namespace Domain\Shopping\Aggregate\Cart;

class Aggregate
{
    protected function handle_create(
        Command\Create $command
    )
    {
        $this->assert->not(Invariant\Created::class);

        $this->assert->is(Invariant\OnlyActiveMemberCart::class,
            [$command->cart->member_id()]
        );

        $this->apply(new Event\Created(
            $command->id(),
            $command->cart
        ));
    }

    protected function handle_add_product_to_cart(
        Command\AddProductToCart $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);
        $this->assert->not(Invariant\Full::class);
        $this->assert->not(Invariant\ExistingProduct::class,
            [$command->product_id]
        );

        $this->apply(new Event\ProductAddedToCart(
            $command->id(),
            $command->product
        ));
    }

    protected function handle_change_product_quantity(
        Command\ChangeProductQuantity $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);
        $this->assert->is(Invariant\ExistingProduct::class,
            [$command->product_id]
        );

        $this->apply(new Event\ProductQuantityChanged(
            $command->id(),
            $command->product
        ));
    }

    protected function handle_remove_product_from_cart(
        Command\RemoveProductFromCart $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);
        $this->assert->not(Invariant\Emptied::class);
        $this->assert->is(Invariant\ExistingProduct::class,
            [$command->product_id]
        );

        $this->apply(new Event\ProductRemovedFromCart(
            $command->id(),
            $command->product_id
        ));
    }

    protected function handle_checkout(
        Command\Checkout $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);

        $this->apply(new Event\CheckedOut(
            $command->id()
        ));
    }
}
