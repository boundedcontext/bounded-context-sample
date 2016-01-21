<?php namespace Domain\Test\Aggregate\User\State\Invariant;

use BoundedContext\Contracts\Business\Invariant\Invariant;
use Domain\Test\Aggregate\User;

class IsNotCreated implements Invariant
{
    private $state;

    public function __construct(User\State $state)
    {
        $this->state = $state;
    }

    public function is_satisfied()
    {
        return ($this->state->is_created == 0);
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new \Exception("The User is already created.");
        }
    }
}
