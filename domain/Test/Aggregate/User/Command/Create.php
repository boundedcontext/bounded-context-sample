<?php

namespace Domain\Test\Aggregate\User\Command;

use BoundedContext\Command\Command;
use BoundedContext\ValueObject\Uuid;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\Password;
use Domain\Test\ValueObject\Username;

class Create implements Command
{
    private $id;
    public $username;
    public $email;
    public $password;

    public function __construct(Uuid $id, Username $username, EmailAddress $email, Password $password)
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
