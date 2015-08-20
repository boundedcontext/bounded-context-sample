<?php

namespace BoundedContext\Contracts;

use BoundedContext\ValueObject\Uuid;

interface Stream {

    public function last_id();

    public function move_to(Uuid $id);

    public function has_next();

    public function next();
}