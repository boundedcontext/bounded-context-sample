<?php namespace Infrastructure\Domain\Shopping\Cart\Projection\OnlyActiveMemberCart;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use Domain\Shopping\Entity\Cart;

class Projection extends AbstractProjection implements \Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart\Projection
{
    protected $table = 'projections_domain_shopping_active_carts';

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
            'member_id' => $cart->member_id()->serialize()
        ]);
    }

    public function checkout(Identifier $cart_id)
    {
        $this->query()
            ->where('id', $cart_id->serialize())
            ->delete();
        ;
    }
}
