<?php namespace Infrastructure\Domain\Projection\UsernameMustBeUnique;

use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;
use Domain\Test\ValueObject\Username;

class Queryable extends AbstractQueryable implements \Domain\Test\Invariant\UsernameMustBeUnique\Projection\Queryable
{
    protected $table = 'projections_domain_test_active_usernames';

    public function exists(Username $username)
    {
        $username_count = $this->query()
            ->where('username', $username->serialize())
            ->count();

        return $username_count > 0;
    }
}
