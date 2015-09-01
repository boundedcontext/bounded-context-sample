<?php

namespace Domain\Test\Aggregate\User;

use BoundedContext\Aggregate\AbstractAggregate;

use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\Password;
use Domain\Test\ValueObject\Username;

class Aggregate extends AbstractAggregate implements \BoundedContext\Contracts\Aggregate
{
    public function create(Username $username, EmailAddress $email, Password $password)
    {
        (new Invariant\IsNotCreated($this->state))->assert();

        $this->apply(new Event\Created(
            $this->id(),
            $username,
            $email,
            $password->encrypt()
        ));
    }

    public function change_username(Username $username)
    {
        (new Invariant\IsCreated($this->state))->assert();

        (new Invariant\UsernameMustBeDifferent(
            $this->state,
            $username
        ))->assert();

        $this->apply(new Event\UsernameChanged(
            $this->id(),
            $this->state->username,
            $username
        ));
    }

    public function delete()
    {
        (new Invariant\IsNotDeleted($this->state))->assert();

        $this->apply(
            new Event\Deleted($this->id())
        );
    }
}
