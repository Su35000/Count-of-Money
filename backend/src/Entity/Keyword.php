<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\KeywordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KeywordRepository::class)]
#[ApiResource]
class Keyword
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $uri = null;

    #[ORM\ManyToMany(targetEntity: UserPreference::class, inversedBy: 'keywords')]
    private Collection $userPreference;

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

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): static
    {
        $this->uri = $uri;

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
}
