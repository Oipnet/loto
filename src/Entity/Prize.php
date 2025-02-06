<?php

namespace App\Entity;

use App\Enum\PrizeState;
use App\Enum\WinningCondition;
use App\Repository\PrizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PrizeRepository::class)]
class Prize
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $sort = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'prizes')]
    private ?Game $game = null;

    #[ORM\Column(enumType: WinningCondition::class)]
    private ?WinningCondition $winningCondition = null;

    /**
     * @var Collection<int, PrizeNumber>
     */
    #[ORM\OneToMany(targetEntity: PrizeNumber::class, mappedBy: 'prize', orphanRemoval: true)]
    private Collection $prizeNumbers;

    #[ORM\Column(enumType: PrizeState::class, options: ['default' => PrizeState::PENDING])]
    private ?PrizeState $state = PrizeState::PENDING;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields: ['title'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->prizeNumbers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getWinningCondition(): ?WinningCondition
    {
        return $this->winningCondition;
    }

    public function getWinningConditionForHuman(): string
    {
        return $this->winningCondition->value;
    }

    public function setWinningCondition(WinningCondition $winningCondition): static
    {
        $this->winningCondition = $winningCondition;

        return $this;
    }

    /**
     * @return Collection<int, PrizeNumber>
     */
    public function getPrizeNumbers(): Collection
    {
        return $this->prizeNumbers;
    }

    public function addPrizeNumber(PrizeNumber $prizeNumber): static
    {
        if (!$this->prizeNumbers->contains($prizeNumber)) {
            $this->prizeNumbers->add($prizeNumber);
            $prizeNumber->setPrize($this);
        }

        return $this;
    }

    public function removePrizeNumber(PrizeNumber $prizeNumber): static
    {
        if ($this->prizeNumbers->removeElement($prizeNumber)) {
            // set the owning side to null (unless already changed)
            if ($prizeNumber->getPrize() === $this) {
                $prizeNumber->setPrize(null);
            }
        }

        return $this;
    }

    public function getState(): ?PrizeState
    {
        return $this->state;
    }

    public function getCurrentState(): string
    {
        return $this->state->value;
    }

    public function setCurrentState(string $state): static
    {
        $state = PrizeState::from($state);
        $this->state = $state;

        return $this;
    }

    public function setState(PrizeState $state): static
    {
        $this->state = $state;

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
