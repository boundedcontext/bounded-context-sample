<?php

namespace Domain\Test\Invariant;

use BoundedContext\Contracts\Invariant;
use Domain\Test\Projection\ActiveEmails;
use Domain\Test\ValueObject\EmailAddress;

class EmailMustBeUnique implements Invariant
{
    private $projection;
    private $email;

    public function __construct(ActiveEmails\Projection $projection, EmailAddress $email)
    {
        $this->projection = $projection;
        $this->email = $email;
    }

    public function is_satisfied()
    {
        return (!$this->projection->exists($this->email));
    }

    public function assert()
    {
        if(!$this->is_satisfied())
        {
            throw new \Exception("The email address [".$this->email->serialize()."] already exists.");
        }
    }
}
