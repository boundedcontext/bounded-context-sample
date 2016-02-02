<?php namespace Domain\Shopping\Aggregate\Cart\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Event\AbstractEvent;
use Domain\Shopping\Aggregate\Cart\Entity\Cart;

class Created extends AbstractEvent implements Event
{
    public $cart;

    public function __construct(Identifier $id, Cart $cart)
    {
        parent::__construct($id);

        $this->cart = $cart;
    }
}
