<?php

return [

    'core' => [
        \BoundedContext\Contracts\Projection\AggregateCollections::class =>
            \BoundedContext\Laravel\Illuminate\Projection\AggregateCollections::class,
    ],

    'app' => [
        \App\Projections\Users\Projection::class =>
            \Infrastructure\App\Projection\Users::class,
    ],

    'domain' => [
        \Domain\Test\Projection\ActiveEmails\Projection::class =>
            \Infrastructure\Domain\Projection\ActiveEmails::class,

        \Domain\Test\Projection\ActiveUsernames\Projection::class =>
            \Infrastructure\Domain\Projection\ActiveUsernames::class,
    ]
];