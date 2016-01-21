<?php namespace Domain\Test\Aggregate\User\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Laravel\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

use Domain\Test\Entity\User;

class Created extends AbstractEvent implements Event
{
    public $user;

    public function __construct(Uuid $id, User $user)
    {
        parent::__construct($id);

        $this->user = $user;
    }
}
