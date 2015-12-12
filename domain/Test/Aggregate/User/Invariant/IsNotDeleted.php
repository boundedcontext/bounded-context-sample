<?php

namespace Domain\Test\Aggregate\User\Invariant;

use BoundedContext\Contracts\Business\Invariant;
use Domain\Test\Aggregate\User;

class IsNotDeleted implements Invariant
{
    private $state;

    public function __construct(User\State $state)
    {
        $this->state = $state;
    }

    public function is_satisfied()
    {
        return !$this->state->is_deleted;
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new \Exception("The User is deleted.");
        }
    }
}
