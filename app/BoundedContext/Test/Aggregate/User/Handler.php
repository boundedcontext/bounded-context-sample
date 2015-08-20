<?php

namespace App\BoundedContext\Test\Aggregate\User;

use BoundedContext\Collection\Collection;
use BoundedContext\Command\Handler\AbstractHandler;

use App\BoundedContext\Test\Projection\ActiveUsernames;
use App\BoundedContext\Test\Projection\ActiveEmails;

use App\BoundedContext\Test\Invariant;
use App\BoundedContext\Test\Aggregate\User\Command;

class Handler extends AbstractHandler
{
    private $active_username_projection;
    private $active_email_projection;

    public function __construct(
        Repository $repository,
        ActiveUsernames\Projection $active_username_projection,
        ActiveEmails\Projection $active_email_projection
    )
    {
        parent::__construct($repository);

        $this->active_username_projection = $active_username_projection;
        $this->active_email_projection = $active_email_projection;
    }

    protected function handle_create(Command\Create $command)
    {
        (new Invariant\UsernameMustBeUnique(
            $this->active_username_projection,
            $command->username
        ))->assert();

        (new Invariant\EmailMustBeUnique(
            $this->active_email_projection,
            $command->email
        ))->assert();

        $aggregate = new Aggregate($command->id(), new Collection());

        $aggregate->create(
            $command->username,
            $command->email,
            $command->password
        );

        $this->repository->save($aggregate);
    }

    protected function handle_change_username(Command\ChangeUsername $command)
    {
        (new Invariant\UsernameMustBeUnique(
            $this->active_username_projection,
            $command->username
        ))->assert();

        $aggregate = $this->repository->get($command->id());
        $aggregate->change_username($command->username);

        $this->repository->save($aggregate);
    }

    protected function handle_delete(Command\Delete $command)
    {
        $aggregate = $this->repository->get($command->id());
        $aggregate->delete();

        $this->repository->save($aggregate);
    }
}
