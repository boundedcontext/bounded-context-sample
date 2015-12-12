<?php

namespace Domain\Test\Aggregate\User\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\ValueObject\Uuid;

class Delete extends AbstractCommand implements Command
{
    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }
}
