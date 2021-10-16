<?php

namespace App\Entity;

use App\Repository\CodedCurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=CodedCurrencyRepository::class)
 */
class CodedCurrency
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $code;

    /**
     * @ORM\OneToMany(targetEntity=Account::class, mappedBy="codedCurrency")
     */
    private $accounts;

    public function __construct(int $code)
    {
        $this->code = $code;
        $this->accounts = new ArrayCollection();
    }

    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return Collection|Account[]
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    public function addAccount(Account $account): self
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts[] = $account;
            $account->setCodedCurrency($this);
        }

        return $this;
    }

    public function removeAccount(Account $account): self
    {
        if ($this->accounts->removeElement($account)) {
            // set the owning side to null (unless already changed)
            if ($account->getCodedCurrency() === $this) {
                $account->setCodedCurrency(null);
            }
        }

        return $this;
    }

}
