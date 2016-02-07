<?php namespace Infrastructure\Domain\Shopping\Cart\Upgrader\Event;

use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\Schema\Upgrader\AbstractUpgrader;

class ProductAdded extends AbstractUpgrader implements Upgrader
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
