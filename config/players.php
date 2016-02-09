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
            '121837f2-6b4a-4450-855a-94bc23d2db49' => \Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart\Projector::class,
        ],

        'workflows' => [
            //'7dfbdd06-56f6-4f7b-84d5-3a2a3ac9c355' => \Domain\Test\Workflows\User::class,
            //'69f8c213-7536-492d-bf21-1a6a227593d7' => \Domain\Test\Workflows\Another::class,
        ],
    ]
];
