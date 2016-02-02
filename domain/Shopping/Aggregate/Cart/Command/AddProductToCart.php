<?php namespace Domain\Shopping\Aggregate\Cart\Command;

use BoundedContext\Command\AbstractCommand;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Shopping\Entity\Product;

class AddProductToCart extends AbstractCommand implements Command
{
    public $product;

    public function __construct(Identifier $id, Product $product)
    {
        parent::__construct($id);

        $this->product = $product;
    }
}
