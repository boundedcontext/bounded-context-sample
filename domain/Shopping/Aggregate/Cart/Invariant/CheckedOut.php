<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Contracts\Business\Invariant\Invariant as InvariantContract;

interface CheckedOut extends InvariantContract
{
    /* No need to fully implement this */
}
