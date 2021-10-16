<?php

namespace SelfWritten\GraphQL;


class Context
{
    private ?array $user = null;

    public function __construct(?array $user)
    {
        $this->user = $user;
    }

    public function getUser(): ?array
    {
        return  $this->user;
    }
}