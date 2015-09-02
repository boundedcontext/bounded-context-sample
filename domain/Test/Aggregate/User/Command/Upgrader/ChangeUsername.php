<?php namespace Domain\Test\Aggregate\User\Command\Upgrader;

use BoundedContext\Contracts\Upgrader;
use BoundedContext\Contracts\Schema;

use BoundedContext\Upgrader\AbstractUpgrader;

class ChangeUsername extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('username');
    }
}
