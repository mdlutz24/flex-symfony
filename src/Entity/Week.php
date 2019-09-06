<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WeekRepository")
 */
class Week
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NflGame", mappedBy="week")
     */
    private $nflGames;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Roster", mappedBy="week", orphanRemoval=true)
     */
    private $rosters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NflTeam", mappedBy="byeWeek")
     */
    private $teamsOnBye;

    public function __construct()
    {
        $this->nflGames = new ArrayCollection();
        $this->rosters = new ArrayCollection();
        $this->teamsOnBye = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection|NflGame[]
     */
    public function getNflGames(): Collection
    {
        return $this->nflGames;
    }

    public function addNflGame(NflGame $nflGame): self
    {
        if (!$this->nflGames->contains($nflGame)) {
            $this->nflGames[] = $nflGame;
            $nflGame->setWeek($this);
        }

        return $this;
    }

    public function removeNflGame(NflGame $nflGame): self
    {
        if ($this->nflGames->contains($nflGame)) {
            $this->nflGames->removeElement($nflGame);
            // set the owning side to null (unless already changed)
            if ($nflGame->getWeek() === $this) {
                $nflGame->setWeek(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Roster[]
     */
    public function getRosters(): Collection
    {
        return $this->rosters;
    }

    public function addRoster(Roster $roster): self
    {
        if (!$this->rosters->contains($roster)) {
            $this->rosters[] = $roster;
            $roster->setWeek($this);
        }

        return $this;
    }

    public function removeRoster(Roster $roster): self
    {
        if ($this->rosters->contains($roster)) {
            $this->rosters->removeElement($roster);
            // set the owning side to null (unless already changed)
            if ($roster->getWeek() === $this) {
                $roster->setWeek(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NflTeam[]
     */
    public function getTeamsOnBye(): Collection
    {
        return $this->teamsOnBye;
    }

    public function addTeamsOnBye(NflTeam $teamsOnBye): self
    {
        if (!$this->teamsOnBye->contains($teamsOnBye)) {
            $this->teamsOnBye[] = $teamsOnBye;
            $teamsOnBye->setByeWeek($this);
        }

        return $this;
    }

    public function removeTeamsOnBye(NflTeam $teamsOnBye): self
    {
        if ($this->teamsOnBye->contains($teamsOnBye)) {
            $this->teamsOnBye->removeElement($teamsOnBye);
            // set the owning side to null (unless already changed)
            if ($teamsOnBye->getByeWeek() === $this) {
                $teamsOnBye->setByeWeek(null);
            }
        }

        return $this;
    }
}
