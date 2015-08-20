<?php

namespace App\BoundedContext\Test\Workflow;

use App\BoundedContext\Test\Projection\ActiveEmails;

class SayHi
{
    public function when_test_user_created(Item $item)
    {
        var_dump("Hello " .$item->event()->username . "!");
    }
}
