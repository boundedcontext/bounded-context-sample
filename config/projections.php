<?php

return [

    'application' => [
        /*
        \App\Projections\Users\Projection::class =>
            \Infrastructure\App\Projection\Users\Projection::class,
        */
    ],

    'domain' => [

        \Domain\Shopping\Aggregate\Cart\Projection\OnlyActiveMemberCart\Projection::class,
            Infrastructure\Domain\Shopping\Cart\Projection\OnlyActiveMemberCart\Projection::class,
    ]
];
