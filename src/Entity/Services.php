<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
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
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity=Amenagement::class, mappedBy="services")
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

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

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
            $amenagement->setServices($this);
        }

        return $this;
    }

    public function removeAmenagement(Amenagement $amenagement): self
    {
        if ($this->amenagements->contains($amenagement)) {
            $this->amenagements->removeElement($amenagement);
            // set the owning side to null (unless already changed)
            if ($amenagement->getServices() === $this) {
                $amenagement->setServices(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->designation;
    }
}
