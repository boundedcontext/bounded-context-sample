<?php namespace Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart;

use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\Entity\Cart;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    /**
     * Adds a new active Cart for a Member.
     *
     * @param Cart $cart
     * @return void
     */
    public function create(Cart $cart);

    /**
     * Checks out an existing member's cart.
     *
     * @param Identifier $cart_id
     * @return void
     */
    public function checkout(Identifier $cart_id);
}
