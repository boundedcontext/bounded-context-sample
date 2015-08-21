<?php

namespace Infrastructure;

use BoundedContext\Collection\Collectable;
use BoundedContext\Log\Item;
use BoundedContext\Stream\Stream;
use BoundedContext\ValueObject\DateTime;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;
use BoundedContext\ValueObject\Version;

class Log implements \BoundedContext\Contracts\Log
{
    private $items;

    public function __construct(Collection $items)
    {
        $this->items = $items;
    }

    public function get_stream(Uuid $id = null)
    {
        $stream = new Stream($this);

        if(!is_null($id))
        {
            $stream->move_to($id);
        }

        return $stream;
    }

    public function get_collection(Uuid $id = null, $limit = 1000)
    {
        $items = new Collection();

        $collect = 0;

        if(is_null($id))
        {
            $collect = 1;
        }

        foreach($this->items as $item)
        {
            if($items->count() >= $limit)
            {
                return $items;
            }

            if($collect)
            {
                $items->append($item);
            }

            if(is_null($id) || $item->id()->equals($id))
            {
                $collect = 1;
            }
        }

        return $items;
    }

    public function append(Collectable $event)
    {
        $item = new Item(
            Uuid::generate(),
            Uuid::generate(),
            DateTime::now(),
            new Version(1),
            $event
        );

        $this->items->append($item);

        return $item;
    }

    public function append_collection(Collection $events)
    {
        $items = new Collection();

        foreach($events as $event)
        {
            $item = $this->append($event);
            $items->append($item);
        }

        return $items;
    }
}