<?php namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;

class RemoveProductFromCart extends AbstractCommand implements Command
{
    public $product_id;

    public function __construct(Identifier $id, Identifier $product_id)
    {
        parent::__construct($id);

        $this->product_id = $product_id;
    }
}
