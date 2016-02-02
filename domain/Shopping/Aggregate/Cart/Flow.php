<?php namespace Domain\Shopping\Aggregate\Cart;

class Flow
{
    /**
     * @name is_created
     * @type \BoundedContext\ValueObject\Boolean
     */
    public $is_created;

    /**
     * @name is_empty
     * @type \BoundedContext\ValueObject\Boolean
     */
    public $is_empty;

    /**
     * @name is_full
     * @type \BoundedContext\ValueObject\Boolean
     */
    public $is_full;

    /**
     * @name is_checked_out
     * @type \BoundedContext\ValueObject\Boolean
     */
    public $is_checked_out;

    /**
     * @name products
     * @type \BoundedContext\Index\Index<\Domain\Shopping\Aggregate\Cart\Entity\Product>
     */
    public $products;

    public function created()
    {
        $this->is_created = 1;
    }

    public function empty()
    {
        $this->is_empty = 1;
    }

    public function not_empty()
    {
        $this->is_empty = 0;
    }

    public function not_full()
    {
        $this->is_full = 0;
    }

    public function full()
    {
        $this->is_full = 1;
    }

    public function checked_out()
    {
        $this->is_checked_out = 1;
    }
}
