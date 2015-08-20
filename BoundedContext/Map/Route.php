<?php namespace BoundedContext\Map;

use BoundedContext\Versionable;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Identifiable;
use BoundedContext\Collection\Collectable;

class Route implements Identifiable, Versionable, Collectable
{

    private $id;
    private $class_namespace;
    private $version;

    public function __construct(Uuid $id, $class_namespace, $version = 1)
    {
        $this->id = $id;
        $this->class_namespace = $class_namespace;
        $this->version = $version;
    }

    public function id()
    {
        return $this->id;
    }

    public function version()
    {
        return $this->version;
    }

    public function class_namespace()
    {
        return $this->class_namespace;
    }
}
