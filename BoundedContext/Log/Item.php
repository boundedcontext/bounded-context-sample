<?php namespace BoundedContext\Log;

use BoundedContext\Event\Event;
use BoundedContext\Projector\Projectable;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Contracts\Versionable;
use BoundedContext\Contracts\Identifiable;
use BoundedContext\Collection\Collectable;

class Item implements Identifiable, Versionable, Projectable, Collectable
{
    private $id;
    private $type_id;
    private $occured_at;
    private $version;
    private $event;

    public function __construct(Uuid $id, Uuid $type_id, \DateTime $occured_at, $version, Event $event)
    {
        $this->id = $id;
        $this->type_id = $type_id;
        $this->occured_at = $occured_at;
        $this->version = (int) $version;
        $this->event = $event;
    }

    public function id()
    {
        return $this->id;
    }

    public function type_id()
    {
        return $this->type_id;
    }

    public function occured_at()
    {
        return $this->occured_at;
    }

    public function version()
    {
        return $this->version;
    }

    public function event()
    {
        return $this->event;
    }

    /*public function to_array()
    {
        return [
            'id' => $this->id->toString(),
            'type_id' => $this->type_id->toString(),
            'occured_at' => $this->occured_at->format(\DateTime::ISO8601),
            'version' => (int) $this->version,
            'payload' => $this->payload->to_array(),
        ];
    }*/
}
