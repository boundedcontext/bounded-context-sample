<?php

return [
    'application' => [
        \App\Projections\Users\Projection::class => \Infrastructure\App\Projection\Users\Projection::class,
    ],

    'domain' => [
        \Domain\Test\Projection\Invariant\EmailAddressMustBeUnique\Projection\Projection::class =>
            \Infrastructure\Domain\Projection\ActiveEmails::class,

        \Domain\Test\Projection\Invariant\UsernameMustBeUnique\Projection\Projection::class =>
            \Infrastructure\Domain\Projection\ActiveUsernames::class,
    ]
];
