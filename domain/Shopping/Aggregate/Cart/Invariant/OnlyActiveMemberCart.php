<?php namespace Domain\Shopping\Aggregate\Cart\Invariant;

use BoundedContext\Contracts\Business\Invariant\Invariant as InvariantContract;

interface OnlyActiveMemberCart extends InvariantContract
{
    /* No need to fully implement this */
}
