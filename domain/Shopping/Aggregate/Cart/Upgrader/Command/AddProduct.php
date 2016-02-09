<?php namespace Domain\Shopping\Aggregate\Cart\Upgrader\Command;

use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class AddProduct extends AbstractUpgrader implements Upgrader
{
    protected function when_version_0(Schema $schema)
    {
        $schema->add('product', function() {
            return [
                'id' => null,
                'quantity' => 0
            ];
        });
    }
}
