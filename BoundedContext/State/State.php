<?php

namespace BoundedContext\State;

use BoundedContext\Event\Event;

class State
{
    private function from_camel_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);

        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    private function get_function_name(Event $e)
    {
        $reflect = new \ReflectionClass($e);

        $class_name = $reflect->getShortName();

        return 'when_' . $this->from_camel_case($class_name);
    }

    private function mutate(Event $event)
    {
        $function = $this->get_function_name($event);

        if (!method_exists($this, $function)) {
            throw new \Exception('An event handler could not be found.');
        }

        $this->$function($event);
    }

    public function apply(Event $event)
    {
        $this->mutate($event);
    }
}
