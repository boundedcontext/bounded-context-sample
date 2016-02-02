<?php namespace Domain\Shopping\Aggregate\Cart;

class Queryable
{
    private $projection;

    public function __construct(Projection $projection)
    {
        $this->projection = $projection;
    }

    public function is_created()
    {
        return $this->projection->is_created;
    }
}
