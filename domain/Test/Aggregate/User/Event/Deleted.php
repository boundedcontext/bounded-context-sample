<?php

namespace Domain\Test\Aggregate\User\Event;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

class Deleted extends AbstractEvent
{
    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }
}
