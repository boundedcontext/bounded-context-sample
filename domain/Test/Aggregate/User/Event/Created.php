<?php

namespace Domain\Test\Aggregate\User\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Laravel\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\EncryptedPassword;
use Domain\Test\ValueObject\Username;

class Created extends AbstractEvent implements Event
{
    public $username;
    public $email;
    public $password;

    public function __construct(Uuid $id, Username $username, EmailAddress $email, EncryptedPassword $password)
    {
        parent::__construct($id);

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}
