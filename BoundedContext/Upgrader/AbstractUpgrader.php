<?php namespace BoundedContext\Upgrader;

use BoundedContext\Log\Item;

abstract class AbstractUpgrader implements Upgrader
{
    use Upgrading;

    protected $item;
    protected $payload;
    protected $version;
    protected $event;

    public function __construct(Item $item)
    {
        $this->item = $item;
        $this->payload = (array) $item->payload();
        $this->version = $item->version();
        
        $this->run();
    }
    
    protected function run()
    {
        while($this->can_upgrade()){
            $this->upgrade();
        }
    }

    abstract public function get();
}
