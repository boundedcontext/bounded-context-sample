<?php namespace Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Queryable extends \BoundedContext\Contracts\Projection\Queryable
{
    public function has_active_cart(Identifier $member_id);
}
