<?php

namespace App\BoundedContext\Test\Aggregate\User\Command;

use BoundedContext\Command\Command;
use BoundedContext\ValueObject\Uuid;

class Delete implements Command
{
    private $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
