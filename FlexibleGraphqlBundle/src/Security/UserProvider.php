<?php

namespace App\Security;

use App\Entity\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function refreshUser(UserInterface $user)
    {}

    public function supportsClass(string $class)
    {}

    public function loadUserByUsername(string $username)
    {}

    public function loadUserByIdentifier(string $identifier)
    {}
}
