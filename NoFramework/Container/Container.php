<?php

namespace SelfWritten\Container;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $services;

    public function __construct(array $services)
    {
        $this->services = $services;
    }

    public function get(string $id)
    {
        return $this->services[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }
}