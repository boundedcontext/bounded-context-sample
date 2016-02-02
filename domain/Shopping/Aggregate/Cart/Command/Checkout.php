<?php namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;

class Checkout extends AbstractCommand implements Command
{
    public function __construct(Identifier $id)
    {
        parent::__construct($id);
    }
}
