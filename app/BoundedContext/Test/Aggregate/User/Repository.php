<?php

namespace App\BoundedContext\Test\Aggregate\User;

use BoundedContext\Repository\AbstractRepository;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;

class Repository extends AbstractRepository implements \BoundedContext\Contracts\Repository
{
    protected function generate(Uuid $id, Collection $items)
    {
        return new Aggregate($id, $items);
    }
}
