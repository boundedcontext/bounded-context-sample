<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Business\Invariant\AbstractInvariant;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\Aggregate\Cart\Projection as Queryable;

class ProductExists extends AbstractInvariant implements Invariant
{
    protected $product_id;

    protected function assumptions(Identifier $product_id)
    {
        $this->product_id = $product_id;
    }

    protected function satisfy(Queryable $queryable)
    {
        return $queryable->products->exists(
            $this->product_id
        );
    }
}
