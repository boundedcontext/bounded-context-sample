<?php namespace Domain\Test\ValueObject;

class Password implements \BoundedContext\Contracts\ValueObject
{
    private $password;

    public function __construct($password = '')
    {
        if($password == '')
        {
            throw new \Exception("The password given is not valid.");
        }

        $this->password = $password;
    }

    public function encrypt()
    {
        return new EncryptedPassword($this);
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