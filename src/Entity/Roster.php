<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RosterRepository")
 */
class Roster
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Franchise", inversedBy="rosters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $franchise;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RosterItem", mappedBy="roster", orphanRemoval=true)
     */
    private $rosterItems;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Week", inversedBy="rosters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $week;

    public function __construct()
    {
        $this->rosterItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFranchise(): ?Franchise
    {
        return $this->franchise;
    }

    public function setFranchise(?Franchise $franchise): self
    {
        $this->franchise = $franchise;

        return $this;
    }

    /**
     * @return Collection|RosterItem[]
     */
    public function getRosterItems(): Collection
    {
        return $this->rosterItems;
    }

    public function addRosterItem(RosterItem $rosterItem): self
    {
        if (!$this->rosterItems->contains($rosterItem)) {
            $this->rosterItems[] = $rosterItem;
            $rosterItem->setRoster($this);
        }

        return $this;
    }

    public function removeRosterItem(RosterItem $rosterItem): self
    {
        if ($this->rosterItems->contains($rosterItem)) {
            $this->rosterItems->removeElement($rosterItem);
            // set the owning side to null (unless already changed)
            if ($rosterItem->getRoster() === $this) {
                $rosterItem->setRoster(null);
            }
        }

        return $this;
    }

    public function getWeek(): ?Week
    {
        return $this->week;
    }

    public function setWeek(?Week $week): self
    {
        $this->week = $week;

        return $this;
    }
}
