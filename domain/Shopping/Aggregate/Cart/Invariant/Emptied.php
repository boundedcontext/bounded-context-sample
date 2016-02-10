<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\Shopping\Aggregate\Cart\Projection as Queryable;

class Emptied extends AbstractInvariant implements Invariant
{
    protected function satisfier(Queryable $queryable)
    {
        return ($queryable->products->count() == 0);
    }
}
