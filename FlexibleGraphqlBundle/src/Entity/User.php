<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private string $username;
    private string $role;

    public function __construct(string $username, string $role)
    {
        $this->username = $username;
        $this->role = $role;
    }

    public function getRoles()
    {
        return [$this->role];
    }

    public function hasRole(string $role)
    {
        return $role === $this->role;
    }

    public function getPassword()
    {
        return '';
    }

    public function getSalt()
    {
        return '';
    }

    public function eraseCredentials()
    {
    }

    public function getUsername()
    {
        return $this->getUserIdentifier();
    }

    public function getUserIdentifier()
    {
        return $this->username;
    }
}