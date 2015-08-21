<?php namespace Domain\Test\ValueObject;

class EncryptedPassword implements \BoundedContext\Contracts\ValueObject
{
    private $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function toString()
    {
        return $this->password;
    }

    public function encrypt()
    {
        $this->password = strrev($this->password);
    }

    public function serialize()
    {
        return $this->toString();
    }

    public static function deserialize($password)
    {
        return new EncryptedPassword($password);
    }
}