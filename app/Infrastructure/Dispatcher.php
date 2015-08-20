<?php

namespace App\Infrastructure;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Bus\Dispatcher as BusDispatcher;

use App\BoundedContext\Test\Projection;

use BoundedContext\Contracts\Projection\AggregateCollections;

class Dispatcher implements BusDispatcher
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    private function generate_handler($handler_class)
    {
        $namespaced_handler_class = '\\' . $handler_class;
        $namespaced_handler_class = new \ReflectionClass($namespaced_handler_class);

        $parameters = $namespaced_handler_class->getMethods()[0]->getParameters();

        $params_array = [];
        foreach($parameters as $parameter)
        {
            $params_array[] = $this->app->make($parameter->getClass()->getName());
        }

        $r = new \ReflectionClass($handler_class);

        return $r->newInstanceArgs($params_array);
    }

    private function play_projectors_by_bounded_context($bounded_context_namespace, $app)
    {
        $reflect = new \ReflectionClass($this->app);

        $bindings = $reflect->getProperty('bindings');
        $bindings->setAccessible(true);
        $bindings = array_keys($bindings->getValue($this->app));

        $bounded_context_namespace_bindings = preg_grep(
            "/^".str_replace("\\", "\\\\", $bounded_context_namespace)."/",
            $bindings
        );

        $bounded_context_projector_namespaces = preg_grep(
            "/Projector$/",
            $bounded_context_namespace_bindings
        );

        foreach($bounded_context_projector_namespaces as $projector_namespace)
        {
            $projector = $this->app->make($projector_namespace);
            $projector->play();
        }
    }

    public function dispatchFromArray($command, array $array)
    {

    }

    public function dispatchFrom($command, \ArrayAccess $source, array $extras = array())
    {

    }

    public function dispatch($command, \Closure $afterResolving = null)
    {
        $class = get_class($command);

        $bounded_context_namespace = substr($class, 0, strpos($class, "Aggregate"));
        $aggregate_namespace = substr($class, 0, strpos($class, "Command"));

        $handler_class = $aggregate_namespace . "Handler";
        $handler = $this->generate_handler($handler_class);
        $handler->handle($command);

        $this->play_projectors_by_bounded_context(
            $bounded_context_namespace,
            $this->app
        );
    }

    public function dispatchNow($command, \Closure $afterResolving = null)
    {

    }

    public function pipeThrough(array $pipes)
    {

    }
}