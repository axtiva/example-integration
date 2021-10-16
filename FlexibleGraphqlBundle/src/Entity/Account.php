<?php

namespace App\Entity;

use App\Enum\AccountStatus;
use App\Repository\AccountRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private Uuid $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $number;

    /**
     * @ORM\Column(type="integer")
     */
    private int $amount;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="account_status_enum")
     */
    private AccountStatus $status;

    /**
     * @ORM\ManyToOne(targetEntity=CodedCurrency::class, inversedBy="accounts", fetch="EAGER")
     * @ORM\JoinColumn(name="coded_currency", referencedColumnName="code")
     */
    private ?CodedCurrency $codedCurrency = null;

    /**
     * @ORM\ManyToOne(targetEntity=NamedCurrency::class, inversedBy="accounts", fetch="EAGER")
     * @ORM\JoinColumn(name="named_currency", referencedColumnName="name")
     */
    private ?NamedCurrency $namedCurrency = null;

    public function __construct(string $number)
    {
        $this->id = Uuid::v4();
        $this->number = $number;
        $this->amount = 0;
        $this->createdAt = new DateTimeImmutable();
        $this->setStatus(new AccountStatus(AccountStatus::ACTIVE));
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getStatus(): AccountStatus
    {
        return $this->status;
    }

    public function setStatus(AccountStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCodedCurrency(): ?CodedCurrency
    {
        return $this->codedCurrency;
    }

    public function setCodedCurrency(?CodedCurrency $codedCurrency): self
    {
        $this->codedCurrency = $codedCurrency;

        return $this;
    }

    public function getNamedCurrency(): ?NamedCurrency
    {
        return $this->namedCurrency;
    }

    public function setNamedCurrency(?NamedCurrency $namedCurrency): self
    {
        $this->namedCurrency = $namedCurrency;

        return $this;
    }
}
