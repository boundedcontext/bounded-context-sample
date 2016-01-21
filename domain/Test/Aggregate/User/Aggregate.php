<?php namespace Domain\Test\Aggregate\User;

use BoundedContext\Contracts\Sourced\Aggregate\Aggregate as AggregateContract;
use BoundedContext\Sourced\Aggregate\AbstractAggregate;

use Domain\Test\Aggregate\User\State\Invariant;
use Domain\Test\Entity\User;
use Domain\Test\ValueObject\Username;

class Aggregate extends AbstractAggregate implements AggregateContract
{
    public function create(User $user)
    {
        $this->assert(Invariant\IsNotCreated::class);

        $this->apply(Event\Created::class,
            [$user]
        );
    }

    public function change_username(Username $username)
    {
        $this->assert(Invariant\IsCreated::class);
        $this->assert(Invariant\UsernameMustBeDifferent::class,
            [$username]
        );

        $this->apply(Event\UsernameChanged::class,
            [$this->state->username, $username]
        );

       /* if($this->is_satisfied(Invariant\IsCartFull::class))
        {
            $this->apply(Event\CartIsFull::class);
        };
       */
    }

    public function delete()
    {
        $this->assert(Invariant\IsNotDeleted::class);

        $this->apply(Event\Deleted::class);
    }
}
