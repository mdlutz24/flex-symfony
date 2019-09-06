<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NflGameRepository")
 */
class NflGame
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
    private $kickoff;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NflTeam", inversedBy="nflGames")
     * @ORM\JoinColumn(nullable=false)
     */
    private $homeTeam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NflTeam", inversedBy="nflGames")
     * @ORM\JoinColumn(nullable=false)
     */
    private $awayTeam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Week", inversedBy="nflGames")
     * @ORM\JoinColumn(nullable=false)
     */
    private $week;

    /**
     * @ORM\Column(type="integer")
     */
    private $secondsRemaining;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKickoff(): ?\DateTimeInterface
    {
        return $this->kickoff;
    }

    public function setKickoff(\DateTimeInterface $kickoff): self
    {
        $this->kickoff = $kickoff;

        return $this;
    }

    public function getHomeTeam(): ?NflTeam
    {
        return $this->homeTeam;
    }

    public function setHomeTeam(?NflTeam $homeTeam): self
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    public function getAwayTeam(): ?NflTeam
    {
        return $this->awayTeam;
    }

    public function setAwayTeam(?NflTeam $awayTeam): self
    {
        $this->awayTeam = $awayTeam;

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

    public function getSecondsRemaining(): ?int
    {
        return $this->secondsRemaining;
    }

    public function setSecondsRemaining(int $secondsRemaining): self
    {
        $this->secondsRemaining = $secondsRemaining;

        return $this;
    }
}
