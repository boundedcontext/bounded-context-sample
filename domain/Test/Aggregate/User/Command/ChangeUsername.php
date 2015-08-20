<?php

namespace Domain\Test\Aggregate\User\Command;

use BoundedContext\Command\Command;
use BoundedContext\ValueObject\Uuid;
use Domain\Test\ValueObject\Username;

class ChangeUsername implements Command
{
    private $id;
    public $username;

    public function __construct(Uuid $id, Username $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

    public function id()
    {
        return $this->id;
    }

}
