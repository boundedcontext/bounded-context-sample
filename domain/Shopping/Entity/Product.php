<?php namespace Domain\Shopping\Entity;

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

    public function change_quantity(Quantity $quantity)
    {
        return new Product($this->id, $quantity);
    }
}
