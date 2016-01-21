<?php namespace Domain\Test\Aggregate\User\Upgrader\Command;

use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class Create extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('username');
        $schema->add('email');
        $schema->add('password');
    }
}
