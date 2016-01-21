<?php namespace Domain\Test\Aggregate\User\State;

use Domain\Test\Aggregate\User\Event;

class State
{
    protected function when_created(Event\Created $event)
    {
        $projection->create(
            $event->username,
            $event->email,
            $event->password
        );
    }

    protected function when_username_changed(Event\UsernameChanged $event)
    {
        $projection->change_username(
            $event->username
        );
    }

    protected function when_deleted(Event\Deleted $event)
    {
        $projection->delete();
    }
}
