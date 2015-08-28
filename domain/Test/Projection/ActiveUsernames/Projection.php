<?php

namespace Domain\Test\Projection\ActiveUsernames;

use BoundedContext\ValueObject\Uuid;
use Domain\Test\ValueObject\Username;

interface Projection extends \BoundedContext\Contracts\Projection
{
    public function exists(Username $username);

    public function get(Uuid $id);

    public function add(Uuid $id, Username $username);

    public function remove(Uuid $id);

    public function replace(Uuid $id, Username $old_username, Username $new_username);
}
