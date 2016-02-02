<?php namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Index\Index;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\Boolean;

use Domain\Shopping\Entity\Cart;
use Domain\Shopping\Entity\Product;
use Domain\Shopping\ValueObject\Quantity;

class Projection
{
    /**
     * @name is_created
     * @var  \BoundedContext\ValueObject\Boolean
     * @type \BoundedContext\ValueObject\Boolean
     */
    public $is_created;

    /**
     * @name is_checked_out
     * @var \BoundedContext\ValueObject\Boolean
     * @type \BoundedContext\ValueObject\Boolean
     */
    public $is_checked_out;

    /**
     * @name cart
     * @var \Domain\Shopping\Entity\Cart
     * @type \Domain\Shopping\Entity\Cart
     */
    public $cart;

    /**
     * @var \BoundedContext\Index\Index
     * @id products
     * @type \BoundedContext\Index\Index<\Domain\Shopping\Entity\Product>
     */
    public $products;

    public function create(Cart $cart)
    {
        $this->is_created = new Boolean(true);
        $this->cart = $cart;
        $this->products = new Index();
    }

    public function add_product(Product $product)
    {
        $this->products->add($product);
    }

    public function change_product_quantity(Product $product)
    {
        $this->products->replace($product);
    }

    public function remove_product(Identifier $product_id)
    {
        $this->products->remove($product_id);
    }

    public function checkout()
    {
        $this->is_checked_out = new Boolean(true);
    }
}
