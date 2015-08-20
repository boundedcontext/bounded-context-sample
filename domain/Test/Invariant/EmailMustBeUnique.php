<?php

namespace Domain\Test\Invariant;

use Domain\Test\Projection\ActiveEmails;
use Domain\Test\ValueObject\EmailAddress;

class EmailMustBeUnique
{
    private $projection;
    private $email;

    public function __construct(ActiveEmails\Projection $projection, EmailAddress $email)
    {
        $this->projection = $projection;
        $this->email = $email;
    }

    public function assert()
    {
        if($this->projection->exists($this->email))
        {
            throw new \Exception("The email address [$this->email->toString()] already exists.");
        }
    }
}
