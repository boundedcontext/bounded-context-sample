<?php namespace Domain\Shopping\ValueObject;

use BoundedContext\ValueObject\AbstractValueObject;

class Quantity extends AbstractValueObject implements \BoundedContext\Contracts\ValueObject\ValueObject
{
    protected $quantity;

    public function __construct($quantity = 0)
    {
        $this->quantity = $quantity;
    }

    public function serialize()
    {
        return $this->quantity;
    }
}
