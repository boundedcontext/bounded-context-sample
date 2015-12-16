<?php namespace Domain\Test\ValueObject;

use BoundedContext\ValueObject\AbstractValueObject;

class EncryptedPassword extends AbstractValueObject implements \BoundedContext\Contracts\ValueObject\ValueObject
{
    private $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function encrypt()
    {
        $this->password = strrev($this->password);
    }

    public function serialize()
    {
        return $this->password;
    }

    public static function deserialize($password = null)
    {
        return new EncryptedPassword($password);
    }
}