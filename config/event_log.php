<?php

return new BoundedContext\Collection\Collection([
        new \BoundedContext\Log\Item(
            new \BoundedContext\ValueObject\Uuid('f0c4d179-6f25-4171-a9d4-66ea943a349e'),
            new \BoundedContext\ValueObject\Uuid('cfd9ef79-2cf3-4ee6-805f-619f72352921'),
            new \DateTime,
            1,
            new \App\BoundedContext\Test\Aggregate\User\Event\Created(new \BoundedContext\ValueObject\Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'), 'lyonscf', 'colin@tercet.io', 'password')
        ),
        new \BoundedContext\Log\Item(
            new \BoundedContext\ValueObject\Uuid('5007db80-3d4b-49fe-afd6-68e7fe5a482f'),
            new \BoundedContext\ValueObject\Uuid('cfd9ef79-2cf3-4ee6-805f-619f72352921'),
            new \DateTime,
            1,
            new \App\BoundedContext\Test\Aggregate\User\Event\Created(new \BoundedContext\ValueObject\Uuid('64cbea01-f61b-4135-b7e1-29b486acc7f1'), 'other', 'colin1@tercet.io', 'password')
        ),
        new \BoundedContext\Log\Item(
            new \BoundedContext\ValueObject\Uuid('1512abff-e79e-4eed-af88-69c4941bd9a6'),
            new \BoundedContext\ValueObject\Uuid('cfd9ef79-2cf3-4ee6-805f-619f72352921'),
            new \DateTime,
            1,
            new \App\BoundedContext\Test\Aggregate\User\Event\Created(new \BoundedContext\ValueObject\Uuid('bf307a89-9727-4bdb-96e2-daabee7f7f6a'), 'another', 'colin2@tercet.io', 'password')
        ),
        new \BoundedContext\Log\Item(
            new \BoundedContext\ValueObject\Uuid('1bef97c8-4415-49aa-b285-6048ce9dc467'),
            new \BoundedContext\ValueObject\Uuid('a55e6792-1136-4f79-b6dd-021238e9b615'),
            new \DateTime,
            1,
            new \App\BoundedContext\Test\Aggregate\User\Event\UsernameChanged(new \BoundedContext\ValueObject\Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'), 'lyonscf', 'lyonscf1')
        )
]);