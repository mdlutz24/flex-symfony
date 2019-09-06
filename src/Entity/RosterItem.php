<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RosterItemRepository")
 */
class RosterItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isStarter;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFlex;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Roster", inversedBy="rosterItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roster;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getIsStarter(): ?bool
    {
        return $this->isStarter;
    }

    public function setIsStarter(bool $isStarter): self
    {
        $this->isStarter = $isStarter;

        return $this;
    }

    public function getIsFlex(): ?bool
    {
        return $this->isFlex;
    }

    public function setIsFlex(bool $isFlex): self
    {
        $this->isFlex = $isFlex;

        return $this;
    }

    public function getRoster(): ?Roster
    {
        return $this->roster;
    }

    public function setRoster(?Roster $roster): self
    {
        $this->roster = $roster;

        return $this;
    }
}
