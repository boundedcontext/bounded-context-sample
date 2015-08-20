<?php

namespace App\BoundedContext\Test\Invariant;

use App\BoundedContext\Test\Projection\ActiveUsernames;

class UsernameMustBeUnique
{
    private $projection;
    private $username;

    public function __construct(ActiveUsernames\Projection $projection, $username)
    {
        $this->projection = $projection;
        $this->username = $username;
    }

    public function assert()
    {
        if($this->projection->exists($this->username))
        {
            throw new \Exception("The username [$this->username] already exists.");
        }
    }
}
