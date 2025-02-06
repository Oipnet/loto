<?php

namespace App\Entity;

use App\Enum\GameState;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var Collection<int, Prize>
     */
    #[ORM\OneToMany(targetEntity: Prize::class, mappedBy: 'game', cascade: ['persist'])]
    private Collection $prizes;

    #[ORM\Column(enumType: GameState::class, options: ['default' => GameState::PREPARING])]
    private ?GameState $state = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['name'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->prizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Prize>
     */
    public function getPrizes(): Collection
    {
        return $this->prizes;
    }

    public function getSortedPrizes(): Collection
    {
        $criteria = Criteria::create()
            ->orderBy(['sort' => Criteria::ASC]); // Tri par 'name' en ordre croissant

        // Retourne la collection triée
        return $this->prizes->matching($criteria);
    }

    public function addPrize(Prize $prize): static
    {
        if (!$this->prizes->contains($prize)) {
            $this->prizes->add($prize);
            $prize->setGame($this);
        }

        return $this;
    }

    public function removePrize(Prize $prize): static
    {
        if ($this->prizes->removeElement($prize)) {
            // set the owning side to null (unless already changed)
            if ($prize->getGame() === $this) {
                $prize->setGame(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getState(): ?GameState
    {
        return $this->state;
    }

    public function getCurrentState(): string
    {
        return $this->state->value;
    }

    public function setCurrentState(string $state): static
    {
        $state = GameState::from($state);
        $this->state = $state;

        return $this;
    }

    public function getStateForHuman(): string
    {
        return $this->state->value;
    }

    public function getStateColor(): string
    {
        return $this->state->color();
    }

    public function getStateBackground(): string
    {
        return $this->state->background();
    }

    public function getStateOutline(): string
    {
        return $this->state->outline();
    }

    public function setState(GameState $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
