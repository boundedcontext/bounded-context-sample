<?php namespace Domain\Test\Aggregate\User\Event\Upgrader;

use BoundedContext\Contracts\Upgrader;
use BoundedContext\Contracts\Schema;

use BoundedContext\Upgrader\AbstractUpgrader;

class Deleted extends AbstractUpgrader implements Upgrader
{
    public function when_version_0(Schema $schema)
    {

    }
}
