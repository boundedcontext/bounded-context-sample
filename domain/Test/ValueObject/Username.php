<?php namespace Domain\Test\ValueObject;

class Username implements \BoundedContext\Contracts\ValueObject
{
    private $username;

    public function __construct($username = '')
    {
        $username = (string) $username;

        if($username == '')
        {
            throw new \Exception("The username [$username] is not valid.");
        }

        $this->username = $username;
    }

    public function serialize()
    {
        return $this->username;
    }

    public static function deserialize($username = null)
    {
        return new Username($username);
    }
}