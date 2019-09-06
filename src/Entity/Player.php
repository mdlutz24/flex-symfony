<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Position", inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NflTeam", inversedBy="players")
     */
    private $nflTeam;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $mflId;

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

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getNflTeam(): ?NflTeam
    {
        return $this->nflTeam;
    }

    public function setNflTeam(?NflTeam $nflTeam): self
    {
        $this->nflTeam = $nflTeam;

        return $this;
    }

    public function getMflId(): ?string
    {
        return $this->mflId;
    }

    public function setMflId(string $mflId): self
    {
        $this->mflId = $mflId;

        return $this;
    }
}
