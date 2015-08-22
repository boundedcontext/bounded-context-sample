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