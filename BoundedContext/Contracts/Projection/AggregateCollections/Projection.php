<?php

namespace BoundedContext\Contracts\Projection\AggregateCollections;

use BoundedContext\Collection\Collection;
use BoundedContext\Log\Item;
use BoundedContext\ValueObject\Uuid;

interface Projection extends \BoundedContext\Contracts\Projection {

    public function exists(Uuid $id);

    public function get(Uuid $id);

    public function append(Item $item);

    public function append_collection(Collection $items);
}
