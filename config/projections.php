<?php

return [

    \BoundedContext\Contracts\Projection\AggregateCollections\Projection::class =>
        \Infrastructure\Projection\AggregateCollections\Projection::class,

    \Domain\Test\Projection\ActiveEmails\Projection::class =>
        \Infrastructure\Projection\ActiveEmails::class,

    \Domain\Test\Projection\ActiveUsernames\Projection::class =>
        \Infrastructure\Projection\ActiveUsernames::class

];