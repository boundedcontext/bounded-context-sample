<?php

namespace App\BoundedContext\Test\Aggregate\User;

use BoundedContext\Aggregate\AbstractAggregate;

class Aggregate extends AbstractAggregate implements \BoundedContext\Contracts\Aggregate
{
    protected function generate()
    {
        return new State();
    }

    public function create($username, $email, $password)
    {
        (new Invariant\IsNotCreated($this->state))->assert();

        $this->apply(new Event\Created(
            $this->id(),
            $username,
            $email,
            $password
        ));
    }

    public function change_username($username)
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

        $this->apply(new Event\Deleted($this->id()));
    }
}
