<?php

namespace App\BoundedContext\Test\Aggregate\User\Invariant;

use App\BoundedContext\Test\Aggregate\User;

class IsNotCreated
{
    private $state;

    public function __construct(User\State $state)
    {
        $this->state = $state;
    }

    public function assert()
    {
        if($this->state->is_created == 1)
        {
            throw new \Exception("The User is already created.");
        }
    }

}
