<?php

namespace Infrastructure\App\Projection;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use BoundedContext\ValueObject\DateTime;
use BoundedContext\ValueObject\Uuid;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\EncryptedPassword;
use Domain\Test\ValueObject\Username;

class Users extends AbstractProjection implements \App\Projections\Users\Projection
{
    protected $table = 'projections_app_users';

    public function exists(Uuid $id)
    {
        $user_count = $this->query()
            ->where('id', $id->serialize())
            ->count();

        return $user_count > 0;
    }

    public function create(Uuid $id, DateTime $occurred_at, Username $username, EmailAddress $email, EncryptedPassword $password)
    {
        if($this->exists($id))
        {
            throw new \Exception("The user [$id->serialize()] already exists.");
        }

        $this->query()->insert([
            'id' => $id->serialize(),
            'created_at' => $occurred_at->serialize(),
            'updated_at' => $occurred_at->serialize(),
            'deleted_at' => null,
            'username' => $username->serialize(),
            'email' => $email->serialize(),
            'password' => $password->serialize(),
        ]);
    }

    public function change_username(Uuid $id, DateTime $occurred_at, Username $username)
    {
        if(!$this->exists($id))
        {
            throw new \Exception("The user [$id->serialize()] does not exist.");
        }

        $this->query()
            ->where('id', $id->serialize())
            ->update([
                'updated_at' => $occurred_at->serialize(),
                'username' => $username->serialize()
            ]);
    }

    public function delete(Uuid $id, DateTime $occurred_at)
    {
        if(!$this->exists($id))
        {
            throw new \Exception("The user [$id->serialize()] does not exist.");
        }

        $this->query()
            ->where('id', $id->serialize())
            ->update([
                'deleted_at' => $occurred_at->serialize()
            ]);
    }
}
