<?php

namespace Domain\Test\Projection\ActiveEmails;

use BoundedContext\ValueObject\Uuid;

interface Projection extends \BoundedContext\Contracts\Projection
{
    public function exists($email);

    public function add(Uuid $id, $email);

    public function remove(Uuid $id);

    public function replace(Uuid $id, $old_email, $new_email);
}
