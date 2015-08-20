<?php

namespace App\BoundedContext\Test\Aggregate\User\Event;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

class Created extends AbstractEvent
{
    public $username;
    public $email;
    public $password;

    public function __construct(Uuid $id, $username, $email, $password)
    {
        parent::__construct($id);

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}
