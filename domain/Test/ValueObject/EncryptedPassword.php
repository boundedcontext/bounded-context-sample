<?php namespace Domain\Test\ValueObject;

class EncryptedPassword implements \BoundedContext\Contracts\ValueObject
{
    private $password;

    public function __construct(Password $password)
    {
        $this->password = strrev($password->toString());
    }

    public function toString()
    {
        return $this->password;
    }

    public function serialize()
    {
        return $this->toString();
    }
}