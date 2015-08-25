<?php

namespace Infrastructure\Core\Projection\AggregateCollections;

use BoundedContext\Collection\Collection;
use BoundedContext\Log\Item;
use BoundedContext\Projection\AbstractProjection;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Contracts\Projection\AggregateCollections;

class Projection extends AbstractProjection implements AggregateCollections\Projection
{
    private $aggregates;

    public function __construct()
    {
        parent::__construct();

        $this->aggregates = [];
    }

    public function reset()
    {
        parent::reset();

        $this->aggregates = [];
    }

    public function exists(Uuid $id)
    {
        return array_key_exists($id->serialize(), $this->aggregates);
    }

    public function get(Uuid $id)
    {
        if(!$this->exists($id))
        {
            throw new \Exception("Aggregate [".$id->serialize()."] does not exist.");
        }

        $items = $this->aggregates[$id->serialize()];

        $events = new Collection();
        foreach($items as $item)
        {
            $events->append($item->event());
        }

        return $events;
    }

    public function save()
    {

    }

    public function append(Item $item)
    {
        $id = $item->event()->id();

        if(!$this->exists($id))
        {
            $this->aggregates[$id->serialize()] = new Collection();
        }

        $this->aggregates[$id->serialize()]->append($item);
    }

    public function append_collection(Collection $items)
    {
        foreach($items as $item)
        {
            $this->append($item);
        }
    }
}