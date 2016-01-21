<?php namespace Domain\Test\Projection\Invariant\UsernameMustBeUnique\Projection;

use Domain\Test\ValueObject\Username;

interface Queryable extends \BoundedContext\Contracts\Projection\Projection
{
    public function exists(Username $username);

}
