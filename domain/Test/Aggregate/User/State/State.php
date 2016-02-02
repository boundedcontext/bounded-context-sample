<?php namespace Domain\Test\Aggregate\User\State;

use BoundedContext\Sourced\Aggregate\State\AbstractState;
use BoundedContext\ValueObject\Boolean;
use Domain\Test\Entity\User;
use Domain\Test\ValueObject\Username;

class State extends AbstractState
{
    /**
     * @name is_created
     * @type \BoundedContext\ValueObject\Boolean
     */

    public $is_created;

    /**
     * @name is_deleted
     * @type \BoundedContext\ValueObject\Boolean
     */

    public $is_deleted;

    /**
     * @name user
     * @type \Domain\Test\Entity\User
     */

    public $user;

    public function create(User $user)
    {
        $this->assert(Invariant\IsNotCreated::class);

        $this->is_created = new Boolean(true);
        $this->user = $user;
    }

    public function change_username(Username $username)
    {
        $this->assert(Invariant\IsCreated::class);
        $this->assert(Invariant\UsernameMustBeDifferent::class,
            [$username]
        );

        $this->user = $this->user->change_username($username);
    }

    public function delete()
    {
        $this->assert(Invariant\IsNotDeleted::class);

        $this->is_deleted = new Boolean(true);
    }

    public function undelete()
    {
        $this->is_deleted = new Boolean(false);
    }
}
