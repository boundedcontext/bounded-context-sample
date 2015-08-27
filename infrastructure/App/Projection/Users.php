<?php

namespace Infrastructure\App\Projection;

use BoundedContext\Projection\AbstractProjection;
use BoundedContext\ValueObject\DateTime;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\ValueObject\Version;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\EncryptedPassword;
use Domain\Test\ValueObject\Username;

class Users extends AbstractProjection implements \App\Projections\Users\Projection
{
    private $users;

    public function __construct()
    {
        parent::__construct(Uuid::null(), new Version(0), new Version(0));

        $this->users = [];
    }

    public function reset()
    {
        parent::reset();

        $this->users = [];
    }

    public function exists(Uuid $id)
    {
        return array_key_exists($id->serialize(), $this->users);
    }

    public function create(Uuid $id, DateTime $occurred_at, Username $username, EncryptedPassword $password, EmailAddress $email)
    {
        if($this->exists($id))
        {
            throw new \Exception("The user [$id->serialize()] already exists.");
        }

        $this->users[$id->serialize()] = [
            'created_at' => $occurred_at->serialize(),
            'updated_at' => $occurred_at->serialize(),
            'deleted_at' => null,
            'username' => $username->serialize(),
            'email' => $email->serialize(),
            'password' => $password->serialize(),
        ];
    }

    public function change_username(Uuid $id, DateTime $occurred_at, Username $username)
    {
        if(!$this->exists($id))
        {
            throw new \Exception("The user [$id->serialize()] does not exist.");
        }

        $this->users[$id->serialize()]['updated_at'] = $occurred_at->serialize();
        $this->users[$id->serialize()]['username'] = $username->serialize();
    }

    public function delete(Uuid $id, DateTime $occurred_at)
    {
        if(!$this->exists($id))
        {
            throw new \Exception("The user [$id->serialize()] does not exist.");
        }

        $this->users[$id->serialize()]['deleted_at'] = $occurred_at->serialize();
    }

    public function save()
    {

    }
}
