<?php namespace Domain\Test\Invariant\EmailAddressMustBeUnique;

use BoundedContext\Contracts\Business\Invariant\Invariant as InvariantContract;
use BoundedContext\Contracts\Business\Invariant\Exception;
use Domain\Test\Projection\Invariant\EmailAddressMustBeUnique\Projection\Queryable;
use Domain\Test\ValueObject\EmailAddress;

class Invariant implements InvariantContract
{
    private $queryable;
    private $email;

    public function __construct(Queryable $queryable, EmailAddress $email)
    {
        $this->queryable = $queryable;
        $this->email = $email;
    }

    public function is_satisfied()
    {
        return (!$this->queryable->exists($this->email));
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new Exception("The email address [".$this->email->serialize()."] already exists.");
        }
    }
}
