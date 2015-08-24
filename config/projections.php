<?php

return [

    \BoundedContext\Contracts\Projection\AggregateCollections\Projection::class =>
        \Infrastructure\Core\Projection\AggregateCollections\Projection::class,

    \Domain\Test\Projection\ActiveEmails\Projection::class =>
        \Infrastructure\Domain\Projection\ActiveEmails::class,

    \Domain\Test\Projection\ActiveUsernames\Projection::class =>
        \Infrastructure\Domain\Projection\ActiveUsernames::class

];