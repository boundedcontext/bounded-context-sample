<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Contracts\Business\Invariant\Exception;
use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\Shopping\Aggregate\Cart\Projection;

class CheckedOut implements Invariant
{
    private $projection;

    public function __construct(Projection $projection)
    {
        $this->projection = $projection;
    }

    public function is_satisfied()
    {
        return $this->projection->is_checked_out->true();
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new Exception("The Aggregate is already checked out.");
        }
    }
}
