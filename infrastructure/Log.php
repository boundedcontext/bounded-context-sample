<?php

namespace Infrastructure;

use BoundedContext\Collection\Collectable;
use BoundedContext\Log\Item;
use BoundedContext\Map\Map;
use BoundedContext\Stream\Stream;
use BoundedContext\ValueObject\DateTime;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;
use BoundedContext\ValueObject\Version;

class Log implements \BoundedContext\Contracts\Log
{
    private $event_map;
    private $items;

    public function __construct(Map $event_map, Collection $items)
    {
        $this->event_map = $event_map;

        foreach($items as $item)
        {
            $this->items[] = json_encode($item->serialize());
        }
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

        foreach($this->items as $serialized_item)
        {
            $serialized_item = json_decode($serialized_item, true);

            if($items->count() >= $limit)
            {
                return $items;
            }

            if($collect)
            {
                $type_id = new Uuid($serialized_item['type_id']);
                $event_class = $this->event_map->get_event_class($type_id);

                $item = new Item(
                    new Uuid($serialized_item['id']),
                    $type_id,
                    new DateTime($serialized_item['occurred_at']),
                    new Version(1),
                    $event_class::deserialize($serialized_item['event'])
                );

                $items->append($item);
            }

            $item_id = new Uuid($serialized_item['id']);
            if(is_null($id) || $item_id->equals($id))
            {
                $collect = 1;
            }
        }

        return $items;
    }

    public function append(Collectable $event)
    {
        $type_id = $this->event_map->get_id($event);

        $item = new Item(
            Uuid::generate(),
            $type_id,
            DateTime::now(),
            new Version(1),
            $event
        );

        $this->items[] = json_encode($item->serialize());

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