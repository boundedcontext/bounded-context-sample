<?php

namespace App\Infrastructure\Projection;

use BoundedContext\Projection\AbstractProjection;
use BoundedContext\ValueObject\Uuid;

class ActiveUsernames extends AbstractProjection implements \App\BoundedContext\Test\Projection\ActiveUsernames\Projection
{
    private $active_usernames;
    private $aggregate_index;

    public function __construct()
    {
        parent::__construct();

        $this->active_usernames = [];
        $this->aggregate_index = [];
    }

    public function reset()
    {
        parent::reset();

        $this->active_usernames = [];
        $this->aggregate_index = [];
    }

    public function exists($email)
    {
        return array_key_exists($email, $this->active_usernames);
    }

    public function add(Uuid $id, $username)
    {
        if($this->exists($username))
        {
            throw new \Exception("The username [$username] is already active.");
        }

        $this->aggregate_index[$id->toString()] = $username;
        $this->active_usernames[$username] = 1;
    }

    public function remove(Uuid $id)
    {
        $username = $this->aggregate_index[$id->toString()];

        if(!$this->exists($username))
        {
            throw new \Exception("The username [$username] is not active.");
        }

        unset($this->active_usernames[$username]);
        unset($this->aggregate_index[$id->toString()]);
    }

    public function replace(Uuid $id, $old_username, $new_username)
    {
        $this->remove($id, $old_username);
        $this->add($id, $new_username);
    }
}
