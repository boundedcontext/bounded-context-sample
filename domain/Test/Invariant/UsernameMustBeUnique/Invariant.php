<?php namespace Domain\Test\Invariant\UsernameMustBeUnique;

use BoundedContext\Contracts\Business\Invariant\Invariant as InvariantContract;
use BoundedContext\Contracts\Business\Invariant\Exception;
use Domain\Test\Projection\Invariant\UsernameMustBeUnique\Projection\Queryable;
use Domain\Test\ValueObject\Username;

class Invariant implements InvariantContract
{
    private $queryable;
    private $username;

    public function __construct(Queryable $queryable, Username $username)
    {
        $this->queryable = $queryable;
        $this->username = $username;
    }

    public function is_satisfied()
    {
        return (!$this->queryable->exists($this->username));
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new Exception("The username [".$this->username->serialize()."] already exists.");
        }
    }
}
