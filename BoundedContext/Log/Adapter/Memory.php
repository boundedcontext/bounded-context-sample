<?php namespace BoundedContext\Log\Adapter;

use BoundedContext\Collection\Collection;
use BoundedContext\Log\Item;
use BoundedContext\Map\Map;

class Memory extends Abstracted
{

    private $collection;

    public function __construct(Map $map, Collection $collection)
    {
        parent::__construct($map);

        $this->collection = $collection;
    }

    public function dump()
    {
        return $this->collection;
    }

    protected function append_item(Item $item)
    {
        $this->collection->append($item);
    }
}
