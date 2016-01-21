<?php

namespace Domain\Test\Aggregate\User\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;

use Domain\Test\Entity\User;

class Create extends AbstractCommand implements Command
{
    public $user;

    public function __construct(Identifier $id, User $user)
    {
        parent::__construct($id);

        $this->user = $user;
    }
}
