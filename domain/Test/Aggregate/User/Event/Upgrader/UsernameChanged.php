<?php namespace Domain\Test\Aggregate\User\Event\Upgrader;

use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Contracts\Schema\Schema;

use BoundedContext\Upgrader\AbstractUpgrader;

class UsernameChanged extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('old_username');
        $schema->add('new_username');
    }
}
