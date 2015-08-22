<?php

namespace Infrastructure;

use BoundedContext\Collection\Collectable;
use BoundedContext\Log\Item;
use BoundedContext\Map\Map;
use BoundedContext\Schema\Schema;
use BoundedContext\Stream\Stream;
use BoundedContext\ValueObject\DateTime;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;
use BoundedContext\ValueObject\Version;

class Log implements \BoundedContext\Contracts\Log
{
    private $event_map;
    private $items;

    public function __construct(Map $event_map, $items)
    {
        $this->event_map = $event_map;

        $items = json_decode($items, true);
        foreach($items as $item)
        {
            $this->items[] = json_encode($item, true);
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

                // Some Lookup Strategy
                $aggregate_prefix = substr($event_class, 0, strpos($event_class, "Event"));
                $upgrader_suffix = explode('Event\\', $event_class)[1];
                $upgrader_class = $aggregate_prefix . 'Upgrader\\' . $upgrader_suffix;

                $upgraded_serialized_event = new $upgrader_class(
                    new Schema($serialized_item['event']),
                    new Version($serialized_item['version'])
                );

                $upgraded_serialized_event->run();

                $item = new Item(
                    new Uuid($serialized_item['id']),
                    new Uuid($serialized_item['type_id']),
                    new DateTime($serialized_item['occurred_at']),
                    $upgraded_serialized_event->version(),
                    $event_class::deserialize($upgraded_serialized_event->schema())
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
        $event_class = $this->event_map->get_event_class($type_id);

        // Some Lookup Strategy
        $aggregate_prefix = substr($event_class, 0, strpos($event_class, "Event"));
        $upgrader_suffix = explode('Event\\', $event_class)[1];
        $upgrader_class = $aggregate_prefix . 'Upgrader\\' . $upgrader_suffix;

        $upgraded_serialized_event = new $upgrader_class(
            new Schema(),
            new Version()
        );

        $upgraded_serialized_event->run();

        $item = new Item(
            Uuid::generate(),
            $type_id,
            DateTime::now(),
            $upgraded_serialized_event->version(),
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