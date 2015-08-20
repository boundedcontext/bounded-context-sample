<?php

namespace App\BoundedContext\Test\Aggregate\User\Invariant;

use App\BoundedContext\Test\Aggregate\User;

class IsNotDeleted
{
    private $state;

    public function __construct(User\State $state)
    {
        $this->state = $state;
    }

    public function assert()
    {
        if($this->state->is_deleted)
        {
            throw new \Exception("The User is deleted.");
        }
    }

}
