<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PositionRepository")
 */
class Position
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $shortName;

    /**
     * @ORM\Column(type="integer")
     */
    private $minStarters;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxStarters;

    /**
     * @ORM\Column(type="integer")
     */
    private $minOnRoster;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxOnRoster;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean")
     */
    private $flexEligible;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="position")
     */
    private $players;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getMinStarters(): ?int
    {
        return $this->minStarters;
    }

    public function setMinStarters(int $minStarters): self
    {
        $this->minStarters = $minStarters;

        return $this;
    }

    public function getMaxStarters(): ?int
    {
        return $this->maxStarters;
    }

    public function setMaxStarters(int $maxStarters): self
    {
        $this->maxStarters = $maxStarters;

        return $this;
    }

    public function getMinOnRoster(): ?int
    {
        return $this->minOnRoster;
    }

    public function setMinOnRoster(int $minOnRoster): self
    {
        $this->minOnRoster = $minOnRoster;

        return $this;
    }

    public function getMaxOnRoster(): ?int
    {
        return $this->maxOnRoster;
    }

    public function setMaxOnRoster(int $maxOnRoster): self
    {
        $this->maxOnRoster = $maxOnRoster;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getFlexEligible(): ?bool
    {
        return $this->flexEligible;
    }

    public function setFlexEligible(bool $flexEligible): self
    {
        $this->flexEligible = $flexEligible;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setPosition($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getPosition() === $this) {
                $player->setPosition(null);
            }
        }

        return $this;
    }
}
