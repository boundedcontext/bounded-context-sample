<?php namespace Domain\Test\Invariant\EmailAddressMustBeUnique\Projection;

use Domain\Test\ValueObject\EmailAddress;

interface Queryable extends \BoundedContext\Contracts\Projection\Queryable
{
    public function exists(EmailAddress $email);
}
