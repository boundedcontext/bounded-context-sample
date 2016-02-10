<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;

use Domain\Shopping\Aggregate\Cart\Projection as Queryable;

class CheckedOut extends AbstractInvariant implements Invariant
{
    protected function satisfier(Queryable $queryable)
    {
        return $queryable->is_checked_out->true();
    }
}
