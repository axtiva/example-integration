<?php

namespace SelfWritten\Entity;

use Symfony\Component\Uid\UuidV4;

final class Account
{
    public UuidV4 $id;

    public function __construct(UuidV4 $id)
    {
        $this->id = $id;
    }
}