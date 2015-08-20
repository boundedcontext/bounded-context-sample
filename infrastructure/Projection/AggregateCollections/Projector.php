<?php

namespace Infrastructure\Projection\AggregateCollections;

use BoundedContext\Contracts\Log;
use BoundedContext\Projector\AbstractProjector;
use BoundedContext\Projector\Projectable;
use BoundedContext\Contracts\Projection\AggregateCollections;

class Projector extends AbstractProjector implements AggregateCollections\Projector
{
    public function __construct(Log $log, AggregateCollections\Projection $projection)
    {
        parent::__construct($log, $projection);
    }

    protected function can_apply(Projectable $item)
    {
        return true;
    }

    protected function apply(Projectable $item)
    {
        $this->projection->append($item);
    }
}
