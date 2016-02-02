<?php namespace Domain\Shopping\Aggregate\Cart\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Event\AbstractEvent;

class ProductRemovedFromCart extends AbstractEvent implements Event
{
    public $product_id;

    public function __construct(Identifier $id, Identifier $product_id)
    {
        parent::__construct($id);

        $this->product_id = $product_id;
    }
}
