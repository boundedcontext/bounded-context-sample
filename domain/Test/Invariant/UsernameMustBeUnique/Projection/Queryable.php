<?php namespace Domain\Test\Invariant\UsernameMustBeUnique\Projection;

use Domain\Test\ValueObject\Username;

interface Queryable extends \BoundedContext\Contracts\Projection\Queryable
{
    public function exists(Username $username);
}
