<?php namespace BoundedContext\Projection;

use BoundedContext\Contracts\Projection;
use BoundedContext\ValueObject\Uuid;

abstract class AbstractProjection implements Projection
{
    protected $last_id;
    protected $version;
    protected $count;

    public function __construct(Uuid $last_id = null, $version = 0, $count = 0)
    {
        $this->last_id = $last_id;
        $this->version = $version;
        $this->count = $count;
    }

    public function version()
    {
        return $this->version;
    }

    public function count()
    {
        return $this->count;
    }

    public function last_id()
    {
        return $this->last_id;
    }

    public function reset()
    {
        $this->last_id = null;
        $this->version = 0;
        $this->items_streamed = 0;
    }

    public function increment(Uuid $last_id, $can_apply)
    {
        $this->last_id = $last_id;
        $this->count += 1;

        if($can_apply)
        {
            $this->version += 1;
        }

    }
}
