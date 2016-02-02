<?php namespace Domain\Test\Aggregate\User;

use BoundedContext\Contracts\Sourced\Aggregate\Aggregate as AggregateContract;
use BoundedContext\Sourced\Aggregate\AbstractAggregate;

use Domain\Test\Aggregate\User\State\Invariant;
use Domain\Test\Aggregate\User\State\State;

class Aggregate extends AbstractAggregate implements AggregateContract
{
    protected function when_test_user_created(
        State $state,
        Event\Created $event
    )
    {
        $state->create($event->user);
    }

    protected function when_test_user_username_changed(
        State $state,
        Event\UsernameChanged $event
    )
    {
        $state->change_username($event->new_username);
    }

    protected function when_test_user_deleted(
        State $state,
        Event\Deleted $event
    )
    {
        $state->delete();
    }
}
