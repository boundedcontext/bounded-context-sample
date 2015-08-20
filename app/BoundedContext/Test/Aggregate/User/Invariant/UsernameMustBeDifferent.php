<?php

namespace App\BoundedContext\Test\Aggregate\User\Invariant;

use App\BoundedContext\Test\Aggregate\User;

class UsernameMustBeDifferent
{
    private $state;
    private $new_username;

    public function __construct(User\State $state, $new_username)
    {
        $this->state = $state;
        $this->new_username = $new_username;
    }

    public function assert()
    {
        if($this->state->username == $this->new_username)
        {
            throw new \Exception("The Username is the same.");
        }
    }

}
