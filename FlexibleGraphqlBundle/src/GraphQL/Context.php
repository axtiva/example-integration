<?php

namespace App\GraphQL;

use Symfony\Component\Security\Core\User\UserInterface;

class Context
{
    private ?UserInterface $user = null;

    public function __construct(?UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }
}