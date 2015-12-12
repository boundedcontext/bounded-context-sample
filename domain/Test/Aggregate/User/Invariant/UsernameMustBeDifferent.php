<?php

namespace Domain\Test\Aggregate\User\Invariant;

use BoundedContext\Contracts\Business\Invariant;
use Domain\Test\Aggregate\User;
use Domain\Test\ValueObject\Username;

class UsernameMustBeDifferent implements Invariant
{
    private $state;
    private $new_username;

    public function __construct(User\State $state, Username $new_username)
    {
        $this->state = $state;
        $this->new_username = $new_username;
    }

    public function is_satisfied()
    {
        return ($this->state->username->serialize() !== $this->new_username->serialize());
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new \Exception("The Username is the same.");
        }
    }

}
