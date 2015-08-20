<?php

namespace Domain\Test\Aggregate\User\Command;

use BoundedContext\Command\Command;
use BoundedContext\ValueObject\Uuid;

class Create implements Command
{
    private $id;
    public $username;
    public $email;
    public $password;

    public function __construct(Uuid $id, $username, $email, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function id()
    {
        return $this->id;
    }

}
