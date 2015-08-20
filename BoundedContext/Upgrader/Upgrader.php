<?php namespace BoundedContext\Upgrader;

use BoundedContext\Versionable;
use BoundedContext\Log\Item;

interface Upgrader extends Versionable
{

    public function __construct(Item $item);

    public function get();
}
