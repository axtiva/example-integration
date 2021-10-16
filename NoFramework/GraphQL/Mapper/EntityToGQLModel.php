<?php

declare (strict_types=1);

namespace SelfWritten\GraphQL\Mapper;

use SelfWritten\Entity\Transaction;
use SelfWritten\GraphQL\Model\AccountType;
use SelfWritten\GraphQL\Model\TransactionCodeLogType;
use SelfWritten\GraphQL\Model\TransactionLogInterface;
use SelfWritten\GraphQL\Model\TransactionMessageLogType;
use SelfWritten\GraphQL\Model\TransactionStatusEnum;
use SelfWritten\GraphQL\Model\TransactionType;

class EntityToGQLModel
{
    public static function transaction(Transaction $from, TransactionType $to): void
    {
        $to->id = $from->id->toRfc4122();
        $to->amount = $from->amount;
        $to->account = new AccountType();
        $to->account->id = $from->accountId->toRfc4122();
        $to->status = self::transactionStatusIdToEnum($from->statusId);
        foreach ($from->log ?? [] as $log) {
            if (isset($log['message'])) {
                $logType = new TransactionMessageLogType();
                self::transactionMessageLog($log, $logType);
            } else {
                $logType = new TransactionCodeLogType();
                self::transactionCodeLog($log, $logType);
            }
            $to->log[] = $logType;
        }

        $to->createdAt = $from->createdAt;
    }

    public static function transactionMessageLog(array $from, TransactionMessageLogType $to): void
    {
        $to->message = $from['message'];
    }

    public static function transactionCodeLog(array $from, TransactionCodeLogType $to): void
    {
        $to->code = $from['code'];
    }


    private static function transactionStatusEnumToId(TransactionStatusEnum $enum): int
    {
        $int = Transaction::STATUS_IN_PROGRESS;
        if ($enum->value === TransactionStatusEnum::SUCCESS) {
            $int = Transaction::STATUS_SUCCESS;
        } elseif ($enum->value === TransactionStatusEnum::FAIL) {
            $int = Transaction::STATUS_FAILED;
        }

        return $int;
    }

    private static function transactionStatusIdToEnum(int $int): TransactionStatusEnum
    {
        $enum = TransactionStatusEnum::IN_PROGRESS;
        if ($int === Transaction::STATUS_SUCCESS) {
            $enum = TransactionStatusEnum::SUCCESS;
        } elseif ($int === Transaction::STATUS_FAILED) {
            $enum = TransactionStatusEnum::FAIL;
        }

        return new TransactionStatusEnum($enum);
    }
}