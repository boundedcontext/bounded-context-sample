<?php namespace App\Projections\Users;

use BoundedContext\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\EncryptedPassword;
use Domain\Test\ValueObject\Username;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function create(
        Identifier $id,
        DateTime $created_at,
        Username $username,
        EmailAddress $email,
        EncryptedPassword $password
    );

    public function change_username(
        Identifier $id,
        DateTime $updated_at,
        Username $username
    );

    public function delete(
        Identifier $id,
        DateTime $deleted_at
    );
}
