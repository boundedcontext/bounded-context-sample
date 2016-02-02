<?php namespace Domain\Test\Entity;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Entity\AbstractEntity;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\EncryptedPassword;
use Domain\Test\ValueObject\Username;

class User extends AbstractEntity implements \BoundedContext\Contracts\Entity\Entity
{
    protected $username;
    protected $email;
    protected $password;

    public function __construct(
        Identifier $id,
        Username $username,
        EmailAddress $email,
        EncryptedPassword $password
    )
    {
        parent::__construct($id);

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function change_username(Username $username)
    {
        return new User(
            $this->id,
            $username,
            $this->email,
            $this->password
        );
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }
}
