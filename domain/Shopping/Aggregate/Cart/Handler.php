<?php namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Command\Handler\AbstractHandler;
use Domain\Shopping\Aggregate\Cart\Invariant\MemberMustOnlyHaveOneCart;

class Handler extends AbstractHandler
{
    protected function handle_create(
        Aggregate $aggregate,
        Command\Create $command
    )
    {
        $this->assert(MemberMustOnlyHaveOneCart\Invariant::class,
            [$command->cart->member_id()]
        );

        /* Point for choosing what event to apply based on inter-Cart assertion. */

        $aggregate->apply(new Event\Created(
            $command->id(),
            $command->cart
        ));
    }

    protected function handle_add_product_to_cart(
        Aggregate $aggregate,
        Command\AddProductToCart $command
    )
    {
        /* No inter-Cart Invariants to assert */

        /* Point for choosing what event to apply based on inter-Cart assertion. */

        $aggregate->apply(new Event\ProductAddedToCart(
            $command->id(),
            $command->product
        ));
    }

    protected function handle_change_product_quantity(
        Aggregate $aggregate,
        Command\ChangeProductQuantity $command
    )
    {
        /* No inter-Cart Invariants to assert */

        /* Point for choosing what event to apply based on inter-Cart assertion. */

        $aggregate->apply(new Event\ProductQuantityChanged(
            $command->id(),
            $command->product_id,
            $command->quantity
        ));
    }

    protected function handle_remove_product_from_cart(
        Aggregate $aggregate,
        Command\RemoveProductFromCart $command
    )
    {
        /* No inter-Cart Invariants to assert */

        /* Point for choosing what event to apply based on inter-Cart assertion. */

        $aggregate->apply(new Event\ProductRemovedFromCart(
            $command->id(),
            $command->product_id
        ));
    }

    protected function handle_checkout(
        Aggregate $aggregate,
        Command\Checkout $command
    )
    {
        /* No inter-Cart Invariants to assert */

        /* Point for choosing what event to apply based on inter-Cart assertion. */

        $aggregate->apply(new Event\CheckedOut(
            $command->id()
        ));
    }
}
