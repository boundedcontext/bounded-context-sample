<?php namespace Domain\Shopping\ValueObject\Product;

use BoundedContext\Index\Index as AbstractIndex;
use Domain\Shopping\Entity\Product;

class Index extends AbstractIndex implements \BoundedContext\Contracts\Index\Index
{
    protected $of = Product::class;
}
