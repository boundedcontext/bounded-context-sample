<?php

namespace Domain\Test\Projection\ActiveUsernames;

use BoundedContext\ValueObject\Uuid;

interface Projection extends \BoundedContext\Contracts\Projection
{
    public function exists($username);

    public function add(Uuid $id, $username);

    public function remove(Uuid $id);

    public function replace(Uuid $id, $old_username, $new_username);
}
