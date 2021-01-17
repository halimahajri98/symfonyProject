<?php

namespace App\Entity;

use App\Repository\LotsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LotsRepository::class)
 */
class Lots
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $superficie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity=Amenagement::class, mappedBy="lots")
     */
    private $amenagements;

    public function __construct()
    {
        $this->amenagements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuperficie(): ?float
    {
        return $this->superficie;
    }

    public function setSuperficie(float $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection|Amenagement[]
     */
    public function getAmenagements(): Collection
    {
        return $this->amenagements;
    }

    public function addAmenagement(Amenagement $amenagement): self
    {
        if (!$this->amenagements->contains($amenagement)) {
            $this->amenagements[] = $amenagement;
            $amenagement->setLots($this);
        }

        return $this;
    }

    public function removeAmenagement(Amenagement $amenagement): self
    {
        if ($this->amenagements->contains($amenagement)) {
            $this->amenagements->removeElement($amenagement);
            // set the owning side to null (unless already changed)
            if ($amenagement->getLots() === $this) {
                $amenagement->setLots(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->region;
    }
}
