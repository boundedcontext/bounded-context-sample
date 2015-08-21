<?php

namespace Domain\Test\Aggregate\User\Invariant;

use BoundedContext\Contracts\Invariant;
use Domain\Test\Aggregate\User;

class IsCreated implements Invariant
{
    private $state;

    public function __construct(User\State $state)
    {
        $this->state = $state;
    }

    public function is_satisfied()
    {
        return ($this->state->is_created == 1);
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new \Exception("The User is not created.");
        }
    }
}
