<?php namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\ValueObject\Quantity;

class ChangeProductQuantity extends AbstractCommand implements Command
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
