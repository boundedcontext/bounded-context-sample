<?php

namespace Domain\Test\Aggregate\User\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Laravel\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;
use Domain\Test\ValueObject\Username;

class UsernameChanged extends AbstractEvent implements Event
{
    public $old_username;
    public $new_username;

    public function __construct(Uuid $id, Username $old_username, Username $new_username)
    {
        parent::__construct($id);

        $this->old_username = $old_username;
        $this->new_username = $new_username;
    }
}
