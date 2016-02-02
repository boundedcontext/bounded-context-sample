<?php namespace Domain\Shopping\Aggregate\Cart;

use BoundedContext\Index\Index;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\Boolean;
use Domain\Shopping\Aggregate\Cart\Entity\Cart;
use Domain\Shopping\Aggregate\Cart\Entity\Product;
use Domain\Shopping\ValueObject\Quantity;

class Model
{
    /**
     * @name is_created
     * @type \BoundedContext\ValueObject\Boolean
     */
    public $is_created;

    /**
     * @name is_checked_out
     * @type \BoundedContext\ValueObject\Boolean
     */
    public $is_checked_out;

    /**
     * @name cart
     * @type \Domain\Shopping\Aggregate\Cart\Entity\Cart
     */
    public $cart;

    /**
     * @name products
     * @type \BoundedContext\Index\Index<\Domain\Shopping\Aggregate\Cart\Entity\Product>
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
        $this->products->add($product); // Throws Exists Exception.
    }

    public function change_product_quantity(Identifier $product_id, Quantity $quantity)
    {
        $product = $this->products->get($product_id); // Throws NotExists Exception.

        $product->change_quantity($quantity);

        $this->products->replace($product); // Throws NotExists Exception.
    }

    public function remove_product(Identifier $product_id)
    {
        $this->products->remove($product_id); // Throws Exists Exception.
    }

    public function checkout()
    {
        $this->is_checked_out = new Boolean(true);
    }
}
