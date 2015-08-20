<?php

namespace BoundedContext\Contracts;

use BoundedContext\ValueObject\Uuid;

interface Projection extends Versionable
{
    public function last_id();

    public function count();

    public function reset();

    public function increment(Uuid $last_id, $can_apply);
}