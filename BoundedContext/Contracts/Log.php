<?php

namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collectable;
use BoundedContext\Collection\Collection;
use BoundedContext\ValueObject\Uuid;

interface Log
{
    public function get_stream(Uuid $starting_id = null);

    public function get_collection(Uuid $starting_id = null, $limit = 1000);

    public function append_collection(Collection $collection);

    public function append(Collectable $collectable);
}