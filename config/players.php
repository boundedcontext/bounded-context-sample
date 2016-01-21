<?php

return [

    'application' => [

        'projectors' => [
            '00000000-0000-0000-0000-000000000000' => \App\Projections\Users\Projector::class,
        ],

        'workflows' => [
            '00000000-0000-0000-0000-000000000000' => \App\Workflows\Greeting::class,
            '00000000-0000-0000-0000-000000000000' => \App\Workflows\User::class,
            '00000000-0000-0000-0000-000000000000' => \App\Workflows\Another::class,
        ],
    ],

    'domain' => [

        'projectors' => [

            '00000000-0000-0000-0000-000000000000' => \Domain\Test\Projection\Invariant\EmailAddressMustBeUnique\Projection\Projector::class,
            '00000000-0000-0000-0000-000000000000' => \Domain\Test\Projection\Invariant\UsernameMustBeUnique\Projector\Projection::class,
        ],

        'workflows' => [
            '00000000-0000-0000-0000-000000000000' => \Domain\Test\Workflow\User::class,
            '00000000-0000-0000-0000-000000000000' => \Domain\Test\Workflow\Another::class,
        ],
    ]
];
