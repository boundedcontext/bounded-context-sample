<?php namespace Domain\Shopping\Aggregate\Cart\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Event\AbstractEvent;
use Domain\Shopping\ValueObject\Quantity;

class ProductQuantityChanged extends AbstractEvent implements Event
{
    public $product_id;
    public $quantity;

    /* Could be refactored into just a Product Entity, but for the sake of the demo. */
    public function __construct(Identifier $id, Identifier $product_id, Quantity $quantity)
    {
        parent::__construct($id);

        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
}
