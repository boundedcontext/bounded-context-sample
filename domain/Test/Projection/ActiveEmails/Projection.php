<?php

namespace Domain\Test\Projection\ActiveEmails;

use BoundedContext\Laravel\ValueObject\Uuid;
use Domain\Test\ValueObject\EmailAddress;

interface Projection extends \BoundedContext\Contracts\Projection\Projection
{
    public function exists(EmailAddress $email);

    public function get(Uuid $id);

    public function add(Uuid $id, EmailAddress $email);

    public function remove(Uuid $id);

    public function replace(Uuid $id, EmailAddress $old_email, EmailAddress $new_email);
}
