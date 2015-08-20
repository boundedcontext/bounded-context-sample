<?php

namespace Domain\Test\Aggregate\User;

class State extends \BoundedContext\State\State
{
    public $is_created = 0;
    public $is_deleted = 0;

    public $username = null;
    public $email = null;
    public $password = null;

    protected function when_created(Event\Created $event)
    {
        $this->is_created = 1;

        $this->username = $event->username;
        $this->email = $event->email;
        $this->password = $event->password;
    }

    protected function when_username_changed(Event\UsernameChanged $event)
    {
        $this->username = $event->new_username;
    }

    protected function when_deleted(Event\Deleted $event)
    {
        $this->is_deleted = 1;
    }
}
