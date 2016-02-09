<?php namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;

use Domain\Shopping\Entity\Cart;

class Create extends AbstractCommand implements Command
{
    public $cart;

    public function __construct(Cart $cart)
    {
        parent::__construct($cart->id());

        $this->cart = $cart;
    }
}
