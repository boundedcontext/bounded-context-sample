<?php

return [
    'cfd9ef79-2cf3-4ee6-805f-619f72352921' =>
        \Domain\Shopping\Aggregate\Cart\Event\Created::class,

    'a55e6792-1136-4f79-b6dd-021238e9b615' =>
        \Domain\Shopping\Aggregate\Cart\Event\Emptied::class,

    'fb1685e5-c751-4dd2-a318-40e75f234e4d' =>
        \Domain\Shopping\Aggregate\Cart\Event\Full::class,

    'd60c82d8-48ba-4fe0-aff5-4e46e8413f71' =>
        \Domain\Shopping\Aggregate\Cart\Event\ProductAdded::class,

    '63c4e65f-d87e-4859-a6e0-a290762850fb' =>
        \Domain\Shopping\Aggregate\Cart\Event\ProductQuantityChanged::class,

    '0dece0ab-d06c-4790-b701-4343aa9f42c4' =>
        \Domain\Shopping\Aggregate\Cart\Event\ProductRemoved::class,

    'fa6b1382-5f66-45c2-baf1-17a618fd299d' =>
        \Domain\Shopping\Aggregate\Cart\Event\CheckedOut::class,
];
