<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart\Queryable;

class OnlyActiveMemberCart extends AbstractInvariant implements Invariant
{
    protected $member_id;

    protected function assumptions(Identifier $member_id)
    {
        $this->member_id = $member_id;
    }

    protected function satisfy(Queryable $queryable)
    {
        return (!$queryable->has_active_cart(
            $this->member_id
        ));
    }
}
