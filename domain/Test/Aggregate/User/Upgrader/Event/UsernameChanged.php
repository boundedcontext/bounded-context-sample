<?php namespace Domain\Test\Aggregate\User\Upgrader\Event;

use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Contracts\Schema\Schema;

use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class UsernameChanged extends \BoundedContext\Schema\Upgrader\AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('old_username');
        $schema->add('new_username');

        return $schema;
    }
}
