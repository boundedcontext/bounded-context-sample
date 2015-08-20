<?php namespace Domain\Test\ValueObject;

class EmailAddress implements \BoundedContext\Contracts\ValueObject
{
    private $email;

    public function __construct($email = '')
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new \Exception("The email address [$email] is not valid.");
        }

        $this->email = $email;
    }

    public function toString()
    {
        return $this->email;
    }

    public function serialize()
    {
        return $this->toString();
    }
}