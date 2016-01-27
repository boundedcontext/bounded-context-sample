<?php namespace Infrastructure\App\Projection\Users;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;

class Queryable extends AbstractQueryable implements \App\Projections\Users\Queryable
{
    protected $table = 'projections_app_users';

    public function exists(Identifier $id)
    {
        $user_count = $this->query()
            ->where('id', $id->serialize())
            ->count();

        return $user_count > 0;
    }
}
