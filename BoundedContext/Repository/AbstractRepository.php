<?php

namespace BoundedContext\Repository;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;

use BoundedContext\Contracts\Aggregate;
use BoundedContext\Contracts\Log;
use BoundedContext\Contracts\Projection\AggregateCollections;

abstract class AbstractRepository
{
    private $log;
    private $projector;

    public function __construct(Log $log, AggregateCollections\Projector $projector)
    {
        $this->log = $log;
        $this->projector = $projector;
    }

    abstract protected function generate(Uuid $id, Collection $events);

    public function get(Uuid $id)
    {
        $projection = $this->projector->projection();

        return $this->generate(
            $id,
            $projection->get($id)
        );
    }

    public function save(Aggregate $aggregate)
    {
        $this->log->append_collection(
            $aggregate->changes()
        );

        $this->projector->play();

        $aggregate->flush();
    }
}
