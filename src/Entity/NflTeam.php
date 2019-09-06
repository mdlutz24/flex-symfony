<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NflTeamRepository")
 */
class NflTeam
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
     * @ORM\Column(type="string", length=3)
     */
    private $shortName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="nflTeam")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NflGame", mappedBy="homeTeam")
     */
    private $nflGames;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Week", inversedBy="teamsOnBye")
     * @ORM\JoinColumn(nullable=false)
     */
    private $byeWeek;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->nflGames = new ArrayCollection();
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
            $player->setNflTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getNflTeam() === $this) {
                $player->setNflTeam(null);
            }
        }

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
            $nflGame->setHomeTeam($this);
        }

        return $this;
    }

    public function removeNflGame(NflGame $nflGame): self
    {
        if ($this->nflGames->contains($nflGame)) {
            $this->nflGames->removeElement($nflGame);
            // set the owning side to null (unless already changed)
            if ($nflGame->getHomeTeam() === $this) {
                $nflGame->setHomeTeam(null);
            }
        }

        return $this;
    }

    public function getByeWeek(): ?Week
    {
        return $this->byeWeek;
    }

    public function setByeWeek(?Week $byeWeek): self
    {
        $this->byeWeek = $byeWeek;

        return $this;
    }
}
