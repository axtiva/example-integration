<?php

namespace SelfWritten\Entity;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV6;

final class Transaction
{
    public const STATUS_IN_PROGRESS = 1;
    public const STATUS_SUCCESS = 2;
    public const STATUS_FAILED = 3;

    public UuidV6 $id;
    public int $amount;
    public int $statusId;
    public Uuid $accountId;
    public ?array $log = null;
    public \DateTimeImmutable $createdAt;
    public function __construct(Uuid $accountId, int $amount)
    {
        $this->id = new UuidV6();
        $this->statusId = self::STATUS_IN_PROGRESS;
        $this->createdAt = new \DateTimeImmutable();
        $this->accountId = $accountId;
        $this->amount = $amount;
    }
}