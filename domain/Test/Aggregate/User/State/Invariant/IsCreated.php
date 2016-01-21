<?php namespace Domain\Test\Aggregate\User\State\Invariant;

use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\Test\Aggregate\User;

class IsCreated implements Invariant
{
    private $snapshot;

    public function __construct(User\State\Snapshot $snapshot)
    {
        $this->snapshot = $snapshot;
    }

    public function is_satisfied()
    {
        return ($this->snapshot->is_created == 1);
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new \Exception("The User is not created.");
        }
    }
}
