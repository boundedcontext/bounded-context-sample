<?php

namespace BoundedContext\Command\Handler;

use BoundedContext\Command\Command;
use BoundedContext\Contracts\Repository;

abstract class AbstractHandler
{
	protected $repository;

	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	private function from_camel_case($input)
	{
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);

		$ret = $matches[0];
		foreach ($ret as &$match) {
			$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
		}

		return implode('_', $ret);
	}

	private function get_handler_name(Command $e)
	{
		$reflect = new \ReflectionClass($e);

		$class_name = $reflect->getShortName();

		return 'handle_' . $this->from_camel_case($class_name);
	}

	private function can_handle(Command $command)
	{
		$handler = $this->get_handler_name($command);

		return method_exists($this, $handler);
	}

	public function handle(Command $command)
	{
		if(!$this->can_handle($command))
		{
			throw new \Exception("Command [".get_class($command)."] does not have a hander.");
		}

		$handler = $this->get_handler_name($command);

		return $this->$handler($command);
	}
}
