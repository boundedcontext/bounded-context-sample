<?php namespace BoundedContext\Event;

use BoundedContext\ValueObject\Uuid;

class AbstractEvent implements Event
{
    private $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }

    /*public function toArray()
    {
        $event = [
            'id' => $this->id()->toString()
        ];

        $class_vars = (new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PUBLIC);
        
        foreach ($class_vars as $property) {
            $name = $property->getName();
            $event[$name] = $this->$name;
        }

        return $event;
    }*/
}
