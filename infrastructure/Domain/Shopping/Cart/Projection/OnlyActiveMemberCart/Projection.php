<?php namespace Infrastructure\Domain\Shopping\Cart\Projection\OnlyActiveMemberCart;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use Domain\Shopping\Entity\Cart;

class Projection extends AbstractProjection implements \Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart\Projection
{
    protected $table = 'projections_domain_shopping_cart_active_member_carts';

    /**
     * @var Queryable $queryable
     */
    protected $queryable;

    public function create(
        Cart $cart
    )
    {
        $this->query()->insert([
            'id' => $cart->id()->serialize(),
            'member_id' => $cart->member_id()->serialize(),
            'is_checked_out' => 0
        ]);
    }

    public function checkout(Identifier $cart_id)
    {
        $this->query()
            ->where('id', $cart_id->serialize())
            ->update(['is_checked_out' => 1])
        ;
    }
}
