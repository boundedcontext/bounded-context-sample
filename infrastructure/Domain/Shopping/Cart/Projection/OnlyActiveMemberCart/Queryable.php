<?php namespace Infrastructure\Domain\Shopping\Cart\Projection\OnlyActiveMemberCart;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;

class Queryable extends AbstractQueryable implements \Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart\Queryable
{
    protected $table = 'projections_domain_shopping_cart_active_member_carts';

    public function has_active_cart(
        Identifier $member_id
    )
    {
        $cart_count = $this->query()
            ->where('member_id', $member_id->serialize())
            ->where('is_checked_out', 0)
            ->count();

            return $cart_count > 0;
    }
}
