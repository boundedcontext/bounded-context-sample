<?php namespace Domain\Test\Aggregate\User\Upgrader;

use BoundedContext\Contracts\Upgrader;
use BoundedContext\Contracts\Schema;

use BoundedContext\Upgrader\AbstractUpgrader;
use Domain\Test\Aggregate\User\Event;

class UsernameChanged extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('username');
        $schema->add('new_username');
    }

    protected function when_version_1(Schema $schema)
    {
        $schema->rename('username', 'old_username');
    }
}
