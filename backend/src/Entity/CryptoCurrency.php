<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CryptoCurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CryptoCurrencyRepository::class)]
#[ApiResource]
class CryptoCurrency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $currentPrice = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $openingPrice = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $lowestPriceDay = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $highestPriceDay = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\ManyToMany(targetEntity: UserPreference::class, inversedBy: 'cryptoCurrency')]
    private Collection $userPreference;

    #[ORM\ManyToOne(inversedBy: 'cryptoCurrency')]
    private ?User $user = null;

    public function __construct()
    {
        $this->userPreference = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCurrentPrice(): ?string
    {
        return $this->currentPrice;
    }

    public function setCurrentPrice(string $currentPrice): static
    {
        $this->currentPrice = $currentPrice;

        return $this;
    }

    public function getOpeningPrice(): ?string
    {
        return $this->openingPrice;
    }

    public function setOpeningPrice(string $openingPrice): static
    {
        $this->openingPrice = $openingPrice;

        return $this;
    }

    public function getLowestPriceDay(): ?string
    {
        return $this->lowestPriceDay;
    }

    public function setLowestPriceDay(string $lowestPriceDay): static
    {
        $this->lowestPriceDay = $lowestPriceDay;

        return $this;
    }

    public function getHighestPriceDay(): ?string
    {
        return $this->highestPriceDay;
    }

    public function setHighestPriceDay(string $highestPriceDay): static
    {
        $this->highestPriceDay = $highestPriceDay;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return Collection<int, UserPreference>
     */
    public function getUserPreference(): Collection
    {
        return $this->userPreference;
    }

    public function addUserPreference(UserPreference $userPreference): static
    {
        if (!$this->userPreference->contains($userPreference)) {
            $this->userPreference->add($userPreference);
        }

        return $this;
    }

    public function removeUserPreference(UserPreference $userPreference): static
    {
        $this->userPreference->removeElement($userPreference);

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
}
