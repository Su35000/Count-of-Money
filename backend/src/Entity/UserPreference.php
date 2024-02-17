<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserPreferenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserPreferenceRepository::class)]
#[ApiResource]
class UserPreference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $currency = null;

    #[ORM\OneToOne(inversedBy: 'userPreference', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Keyword::class, mappedBy: 'userPreference')]
    private Collection $keywords;

    #[ORM\ManyToMany(targetEntity: CryptoCurrency::class, mappedBy: 'userPreference')]
    private Collection $cryptoCurrency;

    public function __construct()
    {
        $this->keywords = new ArrayCollection();
        $this->cryptoCurrency = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Keyword>
     */
    public function getKeywords(): Collection
    {
        return $this->keywords;
    }

    public function addKeyword(Keyword $keyword): static
    {
        if (!$this->keywords->contains($keyword)) {
            $this->keywords->add($keyword);
            $keyword->addUserPreference($this);
        }

        return $this;
    }

    public function removeKeyword(Keyword $keyword): static
    {
        if ($this->keywords->removeElement($keyword)) {
            $keyword->removeUserPreference($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, CryptoCurrency>
     */
    public function getCryptoCurrency(): Collection
    {
        return $this->cryptoCurrency;
    }

    public function addCryptoCurrency(CryptoCurrency $cryptoCurrency): static
    {
        if (!$this->cryptoCurrency->contains($cryptoCurrency)) {
            $this->cryptoCurrency->add($cryptoCurrency);
            $cryptoCurrency->addUserPreference($this);
        }

        return $this;
    }

    public function removeCryptoCurrency(CryptoCurrency $cryptoCurrency): static
    {
        if ($this->cryptoCurrency->removeElement($cryptoCurrency)) {
           $cryptoCurrency->removeUserPreference($this);

        }

        return $this;
    }

}
