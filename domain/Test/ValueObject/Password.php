<?php namespace Domain\Test\ValueObject;

use BoundedContext\ValueObject\AbstractValueObject;

class Password extends AbstractValueObject implements \BoundedContext\Contracts\ValueObject\ValueObject
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
        $encrypted_password = new EncryptedPassword($this->password);
        $encrypted_password->encrypt();

        return $encrypted_password;
    }

    public function serialize()
    {
        return $this->password;
    }

    public static function deserialize($password = null)
    {
        return new Password($password);
    }
}