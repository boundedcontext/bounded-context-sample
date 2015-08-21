<?php

namespace Domain\Test\Aggregate\User\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command;
use BoundedContext\ValueObject\Uuid;

use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\Password;
use Domain\Test\ValueObject\Username;

class Create extends AbstractCommand implements Command
{
    public $username;
    public $email;
    public $password;

    public function __construct(Uuid $id, Username $username, EmailAddress $email, Password $password)
    {
        parent::__construct($id);

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}
