<?php namespace Domain\Test\Projection\Invariant\EmailAddressMustBeUnique\Projection;

use BoundedContext\Contracts\ValueObject\Identifier;
use Domain\Test\ValueObject\EmailAddress;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function get(Identifier $id);

    public function add(Identifier $id, EmailAddress $email);

    public function remove(Identifier $id);

    public function replace(
        Identifier $id,
        EmailAddress $old_email,
        EmailAddress $new_email
    );
}
