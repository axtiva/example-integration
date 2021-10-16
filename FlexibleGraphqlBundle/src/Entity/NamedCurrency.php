<?php

namespace App\Entity;

use App\Repository\NamedCurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NamedCurrencyRepository::class)
 */
class NamedCurrency
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=Account::class, mappedBy="namedCurrency")
     */
    private $accounts;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->accounts = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
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
            $account->setNamedCurrency($this);
        }

        return $this;
    }

    public function removeAccount(Account $account): self
    {
        if ($this->accounts->removeElement($account)) {
            // set the owning side to null (unless already changed)
            if ($account->getNamedCurrency() === $this) {
                $account->setNamedCurrency(null);
            }
        }

        return $this;
    }
}
