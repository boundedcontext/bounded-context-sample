<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Contracts\Business\Invariant\Exception;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart\Queryable;

class OnlyActiveMemberCart implements Invariant
{
    private $queryable;
    private $member_id;

    public function __construct(Queryable $queryable, Identifier $member_id)
    {
        $this->queryable = $queryable;
        $this->member_id = $member_id;
    }

    public function is_satisfied()
    {
        return (!$this->queryable->has_active_cart($this->member_id));
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new Exception("The Member " . $this->member_id->serialize() . " already has an active Cart.");
        }
    }
}
