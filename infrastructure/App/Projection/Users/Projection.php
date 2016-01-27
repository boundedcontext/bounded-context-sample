<?php namespace Infrastructure\App\Projection\Users;

use BoundedContext\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\EncryptedPassword;
use Domain\Test\ValueObject\Username;

class Projection extends AbstractProjection implements \App\Projections\Users\Projection
{
    protected $table = 'projections_app_users';

    /**
     * @var Queryable $queryable
     */
    protected $queryable;

    public function create(
        Identifier $id,
        DateTime $occurred_at,
        Username $username,
        EmailAddress $email,
        EncryptedPassword $password
    )
    {
        if($this->queryable->exists($id))
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

    public function change_username(
        Identifier $id,
        DateTime $occurred_at,
        Username $username
    )
    {
        if(!$this->queryable->exists($id))
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

    public function delete(
        Identifier $id,
        DateTime $occurred_at
    )
    {
        if(!$this->queryable->exists($id))
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
