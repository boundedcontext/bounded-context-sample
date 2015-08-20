<?php namespace BoundedContext\Map;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;

class Map
{

    private $routes;
    private $namespace_routes;

    public function __construct(Collection $routes)
    {
        foreach ($routes as $route) {
            $id = $route->id()->toString();
            $class_namespace = $route->class_namespace();

            $this->routes[$id] = $route;
            $this->namespace_routes[$class_namespace] = $route;
        }
    }

    public function get_by_id(Uuid $id)
    {
        if (!isset($this->routes[$id->toString()])) {
            throw new \Exception('The route "' . $id->toString() . '" could not be found.');
        }

        return $this->routes[$id->toString()];
    }

    public function get_by_namespace($class_namespace)
    {
        if (!isset($this->namespace_routes[$class_namespace])) {
            throw new \Exception('The route ' . $class_namespace . ' could not be found.');
        }

        return $this->namespace_routes[$class_namespace];
    }
}
