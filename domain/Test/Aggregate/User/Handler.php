<?php namespace Domain\Test\Aggregate\User;

use BoundedContext\Command\Handler\AbstractHandler;

use Domain\Test\Invariant\UsernameMustBeUnique;
use Domain\Test\Invariant\EmailAddressMustBeUnique;
use Domain\Test\Aggregate\User\Command;

class Handler extends AbstractHandler
{
    protected function handle_create(
        Aggregate $aggregate,
        Command\Create $command
    )
    {
        $this->assert(UsernameMustBeUnique\Invariant::class,
            [$command->user->username()]
        );
        $this->assert(EmailAddressMustBeUnique\Invariant::class,
            [$command->user->email()]
        );

        $aggregate->apply(new Event\Created(
            $command->id(),
            $command->user
        ));
    }

    protected function handle_change_username(
        Aggregate $aggregate,
        Command\ChangeUsername $command
    )
    {
        $this->assert(UsernameMustBeUnique\Invariant::class,
            [$command->username]
        );

        $aggregate->apply(new Event\UsernameChanged(
            $command->id(),
            $command->username,
            $command->username
        ));
    }

    protected function handle_delete(
        Aggregate $aggregate,
        Command\Delete $command
    )
    {
        $aggregate->apply(new Event\Deleted(
            $aggregate->id()
        ));
    }
}
