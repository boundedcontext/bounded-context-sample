<?php namespace Domain\Test\Aggregate\User\Upgrader;

use BoundedContext\Contracts\Upgrader;
use BoundedContext\Contracts\Schema;

use BoundedContext\Upgrader\AbstractUpgrader;

class UsernameChanged extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('old_username');
        $schema->add('new_username');
    }
}
