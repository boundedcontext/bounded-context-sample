<?php

namespace Domain\Test\Aggregate\User\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Laravel\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

class Deleted extends AbstractEvent implements Event
{
    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }
}
