<?php namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;

use Domain\Shopping\Entity\Cart;

class Create extends AbstractCommand implements Command
{
    public $cart;

    public function __construct(Identifier $id, Cart $cart)
    {
        parent::__construct($id);

        $this->cart = $cart;
    }
}
