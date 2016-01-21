<?php namespace Domain\Test\Aggregate\User\State;

use Domain\Test\Aggregate\User\Event;
use Domain\Test\ValueObject\EmailAddress;
use Domain\Test\ValueObject\EncryptedPassword;
use Domain\Test\ValueObject\Username;

class Snapshot
{
    public $is_created = 0;
    public $is_deleted = 0;

    public $username = null;
    public $email = null;
    public $password = null;

    public function __construct()
    {
        $this->is_created = 0;
        $this->is_deleted = 0;

        $this->username = null;
        $this->email = null;
        $this->password = null;
    }

    public function create(
        Username $username,
        EmailAddress $emailAddress,
        EncryptedPassword $password
    )
    {
        $this->is_created = 1;

        $this->username = $username;
        $this->email = $emailAddress;
        $this->password = $password;
    }

    public function change_username(Username $new_username)
    {
        $this->username = $new_username;
    }

    public function delete()
    {
        $this->is_deleted = 1;
    }
}
