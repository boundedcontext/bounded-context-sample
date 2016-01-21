<?php namespace App\Projections\Users;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Queryable extends \BoundedContext\Contracts\Projection\Queryable
{
    public function exists(Identifier $id);
}
