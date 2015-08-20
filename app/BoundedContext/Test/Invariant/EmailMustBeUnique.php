<?php

namespace App\BoundedContext\Test\Invariant;

use App\BoundedContext\Test\Projection\ActiveEmails;

class EmailMustBeUnique
{
    private $projection;
    private $email;

    public function __construct(ActiveEmails\Projection $projection, $email)
    {
        $this->projection = $projection;
        $this->email = $email;
    }

    public function assert()
    {
        if($this->projection->exists($this->email))
        {
            throw new \Exception("The email address [$this->email] already exists.");
        }
    }
}
