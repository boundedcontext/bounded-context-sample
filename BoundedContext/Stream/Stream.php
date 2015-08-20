<?php

namespace BoundedContext\Stream;

use BoundedContext\Contracts\Log;
use BoundedContext\ValueObject\Uuid;

class Stream implements \BoundedContext\Contracts\Stream
{
    private $log;
    private $limit;
    private $chunk_size;

    private $items;

    private $last_item_id;

    public function __construct(Log $log, $limit = 0, $chunk_size = 1000)
    {
        $this->log = $log;
        $this->limit = $limit;
        $this->chunk_size = $chunk_size;

        $this->items = $this->log->get_collection(null, $this->chunk_size);

        $this->last_item_id = null;
    }

    public function last_id()
    {
        return $this->last_item_id;
    }

    public function move_to(Uuid $id)
    {
        $this->items = $this->log->get_collection($id, $this->chunk_size);
        $this->last_item_id = $id;
    }

    public function has_next()
    {
        return $this->items->has_next();
    }

    public function next()
    {
        $item = $this->items->current();

        if($this->has_next())
        {
            $this->items->next();
        }

        return $item;
    }
}