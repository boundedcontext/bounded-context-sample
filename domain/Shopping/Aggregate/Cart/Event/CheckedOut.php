<?php namespace Domain\Shopping\Aggregate\Cart\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Event\AbstractEvent;

class CheckedOut extends AbstractEvent implements Event
{
    public function __construct(Identifier $id)
    {
        parent::__construct($id);
    }
}
