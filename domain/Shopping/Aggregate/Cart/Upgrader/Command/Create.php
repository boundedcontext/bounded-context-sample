<?php namespace Domain\Shopping\Aggregate\Cart\Upgrader\Command;

use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class Create extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('cart', function($cart) {
            return [
                'id' => null,
                'member_id' => null
            ];
        });
    }
}
