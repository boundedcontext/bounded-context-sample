<?php namespace BoundedContext\Log\Adapter;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;
use BoundedContext\Log\Log;
use BoundedContext\Log\Appendable;
use BoundedContext\Log\Item;
use BoundedContext\Map\Map;

abstract class Abstracted implements Log
{

    private $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    protected function generate_item(Appendable $appendable)
    {
        $route = $this->map->get_by_namespace(get_class($appendable));

        return new Item(Uuid::generate(), $route->id(), new \DateTime, $route->version(), $appendable);
    }

    abstract protected function append_item(Item $item);

    public function append_collection(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->append($item);
        }
    }

    public function append(Appendable $appendable)
    {
        $item = $this->generate_item($appendable);

        $this->append_item($item);
    }
}
