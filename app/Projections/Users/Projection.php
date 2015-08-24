<?php namespace App\Projections\Users;

use BoundedContext\ValueObject\DateTime;
use BoundedContext\ValueObject\Uuid;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\EncryptedPassword;
use Domain\Test\ValueObject\Username;

interface Projection extends \BoundedContext\Contracts\Projection
{
    public function exists(Uuid $id);

    public function create(Uuid $id, DateTime $occurred_at, Username $username, EncryptedPassword $password, EmailAddress $email);

    public function change_username(Uuid $id, DateTime $occurred_at, Username $username);

    public function delete(Uuid $id, DateTime $occurred_at);
}
