<?php

return [
    '5225203f-3ff0-44aa-9142-4da277e6c009' =>
        \Domain\Shopping\Aggregate\Cart\Command\Create::class,

    '6cdac48b-a73f-458b-9224-766810458c0b' =>
        \Domain\Shopping\Aggregate\Cart\Command\AddProduct::class,

    '3f48bd5d-e02b-456a-9989-8f839386411b' =>
        \Domain\Shopping\Aggregate\Cart\Command\ChangeProductQuantity::class,

    '5cbd4e62-caf4-4b90-8905-4fcf00fb3a7b' =>
        \Domain\Shopping\Aggregate\Cart\Command\RemoveProduct::class,

    '88791ba6-5b69-41c8-a5b0-27fe1382d6ad' =>
        \Domain\Shopping\Aggregate\Cart\Command\Checkout::class,
];
