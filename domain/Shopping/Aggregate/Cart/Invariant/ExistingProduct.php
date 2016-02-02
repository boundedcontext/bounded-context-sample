<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Contracts\Business\Invariant\Exception;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\Aggregate\Cart\Projection;

class ExistingProduct implements Invariant
{
    private $projection;
    private $product_id;

    public function __construct(Projection $projection, Identifier $product_id)
    {
        $this->projection = $projection;
        $this->product_id = $product_id;
    }

    public function is_satisfied()
    {
        return ($this->projection->products->exists($this->product_id));
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new Exception("The product already exists in the cart.");
        }
    }
}
