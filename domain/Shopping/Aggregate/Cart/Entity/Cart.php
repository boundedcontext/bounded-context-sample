<?php namespace Domain\Shopping\Aggregate\Cart\Entity;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Entity\AbstractEntity;

class Cart extends AbstractEntity implements \BoundedContext\Contracts\Entity\Entity
{
    protected $member_id;

    public function __construct(
        Identifier $id,
        Identifier $member_id
    )
    {
        parent::__construct($id);

        $this->member_id = $member_id;
    }

    public function member_id()
    {
        return $this->member_id;
    }
}
