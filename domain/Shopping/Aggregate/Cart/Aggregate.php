<?php namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Sourced\Aggregate\AbstractAggregate;

class Aggregate extends AbstractAggregate implements \BoundedContext\Contracts\Sourced\Aggregate\Aggregate
{
    protected function handle_create(
        Command\Create $command
    )
    {
        $this->check->that(Invariant\Created::class)
            ->not()
            ->asserts();

        $this->check->that(Invariant\OnlyActiveMemberCart::class)
            ->assuming([$command->cart->member_id()])
            ->asserts();

        /* ---------------- */

        $this->apply(new Event\Created(
            $command->id(),
            $command->cart
        ));

        $this->apply(new Event\Emptied(
            $command->id()
        ));
    }

    protected function handle_add_product(
        Command\AddProduct $command
    )
    {
        $this->check->that(Invariant\CheckedOut::class)
            ->not()
            ->asserts();

        $this->check->that(Invariant\Full::class)
            ->not()
            ->asserts();

        $this->check->that(Invariant\ProductExists::class)
            ->assuming([$command->product->id()])
            ->not()
            ->asserts();

        /* ---------------- */

        $this->apply(new Event\ProductAdded(
            $command->id(),
            $command->product
        ));

        /* ---------------- */

        if($this->check->that(Invariant\Full::class)->is_satisfied())
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
        $this->check->that(Invariant\CheckedOut::class)
            ->not()
            ->asserts();

        $this->check->that(Invariant\ProductExists::class)
            ->assuming([$command->product->id()])
            ->asserts();

        /* ---------------- */

        $this->apply(new Event\ProductQuantityChanged(
            $command->id(),
            $command->product
        ));
    }

    protected function handle_remove_product(
        Command\RemoveProduct $command
    )
    {
        $this->check->that(Invariant\CheckedOut::class)
            ->not()
            ->asserts();

        $this->check->that(Invariant\ProductExists::class)
            ->assuming([$command->product_id])
            ->asserts();

        /* ---------------- */

        $this->apply(new Event\ProductRemoved(
            $command->id(),
            $command->product_id
        ));

        /* ---------------- */

        if($this->check->that(Invariant\Emptied::class)->is_satisfied())
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
        $this->check->that(Invariant\CheckedOut::class)
            ->not()
            ->asserts();

        /* ---------------- */

        $this->apply(new Event\CheckedOut(
            $command->id()
        ));
    }
}
