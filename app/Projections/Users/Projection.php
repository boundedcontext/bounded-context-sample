<?php namespace App\Projections\Users;

use BoundedContext\ValueObject\DateTime;
use BoundedContext\Laravel\ValueObject\Uuid;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\EncryptedPassword;
use Domain\Test\ValueObject\Username;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function exists(Uuid $id);

    public function create(Uuid $id, DateTime $created_at, Username $username, EmailAddress $email, EncryptedPassword $password);

    public function change_username(Uuid $id, DateTime $updated_at, Username $username);

    public function delete(Uuid $id, DateTime $deleted_at);
}
