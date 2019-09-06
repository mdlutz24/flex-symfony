<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FranchiseRepository")
 */
class Franchise
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
     * @ORM\Column(type="string", length=255)
     */
    private $apiKey;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loginCookie;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $mflId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Roster", mappedBy="Franchise", orphanRemoval=true)
     */
    private $rosters;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="Franchise", cascade={"persist", "remove"})
     */
    private $user;

    public function __construct()
    {
        $this->rosters = new ArrayCollection();
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

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function getLoginCookie(): ?string
    {
        return $this->loginCookie;
    }

    public function setLoginCookie(string $loginCookie): self
    {
        $this->loginCookie = $loginCookie;

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
            $roster->setFranchise($this);
        }

        return $this;
    }

    public function removeRoster(Roster $roster): self
    {
        if ($this->rosters->contains($roster)) {
            $this->rosters->removeElement($roster);
            // set the owning side to null (unless already changed)
            if ($roster->getFranchise() === $this) {
                $roster->setFranchise(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        // set the owning side of the relation if necessary
        if ($this !== $user->getFranchise()) {
            $user->setFranchise($this);
        }

        return $this;
    }
}
