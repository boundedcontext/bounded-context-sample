<?php

namespace Domain\Test\Aggregate\User\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\ValueObject\Uuid;
use Domain\Test\ValueObject\Username;

class ChangeUsername extends AbstractCommand implements Command
{
    public $username;

    public function __construct(Uuid $id, Username $username)
    {
        parent::__construct($id);

        $this->username = $username;
    }
}
