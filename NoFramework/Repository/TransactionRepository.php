<?php

namespace SelfWritten\Repository;

use DateTimeImmutable;
use PDO;
use ReflectionClass;
use SelfWritten\Entity\Account;
use SelfWritten\Entity\Transaction;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Uid\UuidV6;

class TransactionRepository
{
    private static PDO $db;

    public function __construct()
    {
        if (empty(self::$db)) {
            self::$db = new PDO('pgsql:host=postgresql;port=5432;dbname=demo;user=root;password=root');
        }
    }

    public function findById(UuidV6 $id): ?Transaction
    {
        $sql = "select {$this->getFields()} from {$this->getTable()} where id = :id";
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue('id', $id->toRfc4122());
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $transaction = null;
        if ($row) {
            $transaction = $this->mapRow($row);
        }

        return $transaction;
    }

    /**
     * @return Transaction[]
     */
    public function findByAccount(Account $account): iterable
    {
        $sql = "select {$this->getFields()} from {$this->getTable()} where account_id = :id";
        $stmt = self::$db->prepare($sql);
        $stmt->bindValue('id', $account->id->toRfc4122());
        $stmt->execute();
        $transactions = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $transactions[] = $this->mapRow($row);
        }

        return $transactions;
    }

    public function insert(Transaction $transaction): Transaction
    {
        $sql = "INSERT INTO {$this->getTable()} ({$this->getFields()}) 
            VALUES (:id, :amount, :status_id, :account_id, :log, :created_at)";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([
            'id' => $transaction->id->toRfc4122(),
            'amount' => (int) $transaction->amount,
            'status_id' => (int) $transaction->statusId,
            'account_id' => $transaction->accountId->toRfc4122(),
            'log' => json_encode($transaction->log),
            'created_at' => $transaction->createdAt->format('c'),
        ]);

        return $transaction;
    }

    private function getTable(): string
    {
        return 'transaction_table';
    }

    private function getFields(): string
    {
        return 'id, amount, status_id, account_id, log, created_at';
    }

    private function mapRow(array $row): Transaction
    {
        $reflection = new ReflectionClass(Transaction::class);
        /** @var Transaction $transaction */
        $transaction = $reflection->newInstanceWithoutConstructor();
        $transaction->id = new UuidV6($row['id']);
        $transaction->amount = (int) $row['amount'];
        $transaction->statusId = (int) $row['status_id'];
        $transaction->accountId = new UuidV4($row['account_id']);
        $transaction->log = $row['log'] ? json_decode($row['log'], true) : null;
        $transaction->createdAt = new DateTimeImmutable($row['created_at']);

        return $transaction;
    }
}