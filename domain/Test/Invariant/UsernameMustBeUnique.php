<?php

namespace Domain\Test\Invariant;

use Domain\Test\Projection\ActiveUsernames;
use Domain\Test\ValueObject\Username;

class UsernameMustBeUnique
{
    private $projection;
    private $username;

    public function __construct(ActiveUsernames\Projection $projection, Username $username)
    {
        $this->projection = $projection;
        $this->username = $username;
    }

    public function assert()
    {
        if($this->projection->exists($this->username))
        {
            throw new \Exception("The username [$this->username->toString()] already exists.");
        }
    }
}
