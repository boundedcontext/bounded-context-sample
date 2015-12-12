<?php namespace Domain\Test\Aggregate\User\Event\Upgrader;

use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Contracts\Schema\Schema;

use BoundedContext\Upgrader\AbstractUpgrader;

class Deleted extends AbstractUpgrader implements Upgrader
{
    public function when_version_0(Schema $schema)
    {

    }
}
