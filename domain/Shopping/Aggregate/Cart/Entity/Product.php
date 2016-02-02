<?php namespace Domain\Shopping\Aggregate\Cart\Entity;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Entity\AbstractEntity;
use Domain\Shopping\ValueObject\Quantity;

class Product extends AbstractEntity implements \BoundedContext\Contracts\Entity\Entity
{
    protected $quantity;

    public function __construct(
        Identifier $id,
        Quantity $quantity
    )
    {
        parent::__construct($id);

        $this->quantity = $quantity;
    }

    public function quantity()
    {
        return $this->quantity;
    }
}
