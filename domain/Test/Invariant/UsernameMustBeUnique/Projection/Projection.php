<?php namespace Domain\Test\Projection\Invariant\UsernameMustBeUnique\Projection;

use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Test\ValueObject\Username;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function exists(Username $username);

    public function get(Identifier $id);

    public function add(Identifier $id, Username $username);

    public function remove(Identifier $id);

    public function replace(Identifier $id, Username $old_username, Username $new_username);
}
