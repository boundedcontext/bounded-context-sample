<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\Shopping\Aggregate\Cart\Projection as Queryable;

class Created extends AbstractInvariant implements Invariant
{
    protected function satisfy(Queryable $queryable)
    {
        return $queryable->is_created->true();
    }
}
