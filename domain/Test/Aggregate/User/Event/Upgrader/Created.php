<?php namespace Domain\Test\Aggregate\User\Event\Upgrader;

use BoundedContext\Contracts\Upgrader;
use BoundedContext\Contracts\Schema;
use BoundedContext\Upgrader\AbstractUpgrader;

class Created extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('username');
        $schema->add('email');
        $schema->add('password');
    }
}
