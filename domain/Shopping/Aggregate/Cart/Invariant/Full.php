<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Contracts\Business\Invariant\Exception;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\Shopping\Aggregate\Cart\Projection;

class Full implements Invariant
{
    private $projection;

    public function __construct(Projection $projection)
    {
        $this->projection = $projection;
    }

    public function is_satisfied()
    {
        return ($this->projection->products->count() >= 10);
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new Exception("The Cart is full.");
        }
    }
}
