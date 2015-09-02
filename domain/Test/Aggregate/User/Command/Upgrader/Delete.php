<?php namespace Domain\Test\Aggregate\User\Command\Upgrader;

use BoundedContext\Contracts\Upgrader;
use BoundedContext\Contracts\Schema;

use BoundedContext\Upgrader\AbstractUpgrader;

class Delete extends AbstractUpgrader implements Upgrader
{
    public function when_version_0(Schema $schema)
    {

    }
}
