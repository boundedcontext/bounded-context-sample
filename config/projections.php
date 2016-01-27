<?php

return [

    'application' => [
        \App\Projections\Users\Projection::class =>
            \Infrastructure\App\Projection\Users\Projection::class,
    ],

    'domain' => [
        \Domain\Test\Invariant\EmailAddressMustBeUnique\Projection\Projection::class =>
            \Infrastructure\Domain\Projection\EmailAddressMustBeUnique\Projection::class,

        \Domain\Test\Invariant\UsernameMustBeUnique\Projection\Projection::class =>
            \Infrastructure\Domain\Projection\UsernameMustBeUnique\Projection::class,
    ]
];
