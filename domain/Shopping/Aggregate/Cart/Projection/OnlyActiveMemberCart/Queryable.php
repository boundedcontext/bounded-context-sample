<?php namespace Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\Boolean;

interface Queryable extends \BoundedContext\Contracts\Projection\Queryable
{
    /**
     * Returns a boolean of whether or not an member has an active cart.
     *
     * @param Identifier $member_id
     * @return Boolean
     */
    public function has_active_cart(Identifier $member_id);
}
