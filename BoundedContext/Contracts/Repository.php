<?php

namespace BoundedContext\Contracts;

use BoundedContext\Contracts;
use BoundedContext\Contracts\Projection\AggregateCollections;
use BoundedContext\ValueObject\Uuid;

/**
 * Interface Repository
 * @package BoundedContext\Contracts
 */
interface Repository {

    /**
     * @param Log $log
     * @param AggregateCollections\Projector $projector
     */
    public function __construct(Contracts\Log $log, AggregateCollections\Projector $projector);

    /**
     * @param Uuid $id
     * @return Aggregate
     */
    public function get(Uuid $id);

    /**
     * @param Aggregate $aggregate
     * @return void
     */
    public function save(Aggregate $aggregate);
}
