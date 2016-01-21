<?php namespace Domain\Test\Aggregate\User\Upgrader\Event;

use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Contracts\Schema\Schema;

use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class Deleted extends \BoundedContext\Schema\Upgrader\AbstractUpgrader implements Upgrader
{
    public function when_version_0(Schema $schema)
    {
        return $schema;
    }
}
