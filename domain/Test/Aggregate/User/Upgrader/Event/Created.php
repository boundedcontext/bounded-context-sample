<?php namespace Domain\Test\Aggregate\User\Upgrader\Event;

use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class Created extends \BoundedContext\Schema\Upgrader\AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('username');
        $schema->add('email');
        $schema->add('password');

        return $schema;
    }
}
