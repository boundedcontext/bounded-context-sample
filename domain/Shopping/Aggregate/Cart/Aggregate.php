<?php namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Sourced\Aggregate\AbstractAggregate;

class Aggregate extends AbstractAggregate implements \BoundedContext\Contracts\Sourced\Aggregate\Aggregate
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

        $this->apply(new Event\Emptied(
            $command->id()
        ));
    }

    protected function handle_add_product_to_cart(
        Command\AddProduct $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);
        $this->assert->not(Invariant\Full::class);
        $this->assert->not(Invariant\ExistingProduct::class,
            [$command->product->id()]
        );

        $this->apply(new Event\ProductAdded(
            $command->id(),
            $command->product
        ));

        if($this->check->is(Invariant\Full::class))
        {
            $this->apply(new Event\Full(
                $command->id()
            ));
        }
    }

    protected function handle_change_product_quantity(
        Command\ChangeProductQuantity $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);
        $this->assert->is(Invariant\ExistingProduct::class,
            [$command->product->id()]
        );

        $this->apply(new Event\ProductQuantityChanged(
            $command->id(),
            $command->product
        ));
    }

    protected function handle_remove_product_from_cart(
        Command\RemoveProduct $command
    )
    {
        $this->assert->not(Invariant\CheckedOut::class);
        $this->assert->is(Invariant\ExistingProduct::class,
            [$command->product_id]
        );

        $this->apply(new Event\ProductRemoved(
            $command->id(),
            $command->product_id
        ));

        if($this->check->is(Invariant\Emptied::class))
        {
            $this->apply(new Event\Emptied(
                $command->id()
            ));
        }
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
