<?php

return [

    'application' => [

        'projectors' => [
            //'811e5df8-d46e-4b30-8de5-fbfe3790f711' => \App\Projections\Users\Projector::class,
        ],

        'workflows' => [
            //'75bc19be-6137-4050-9205-4eb524c22f8f' => \App\Workflows\Greeting::class,
            //'5469ca0d-1f26-4e43-8d59-3948457beceb' => \App\Workflows\User::class,
            //'11a7f132-bd84-4a5c-88a7-8d846ff83de7' => \App\Workflows\Another::class,
        ],
    ],

    'domain' => [

        'projectors' => [

            //'da54ebc1-1b78-4924-97bf-8463d25aafc8' => \Domain\Test\Invariant\EmailAddressMustBeUnique\Projection\Projector::class,
            //'6eaac031-5bc4-4f4b-aae8-8cb80bab27f9' => \Domain\Test\Invariant\UsernameMustBeUnique\Projection\Projector::class,
        ],

        'workflows' => [
            //'7dfbdd06-56f6-4f7b-84d5-3a2a3ac9c355' => \Domain\Test\Workflows\User::class,
            //'69f8c213-7536-492d-bf21-1a6a227593d7' => \Domain\Test\Workflows\Another::class,
        ],
    ]
];
