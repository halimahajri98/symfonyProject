<?php

namespace App\Entity;

use App\Repository\AmenagementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AmenagementRepository::class)
 */
class Amenagement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAmenagement;

    /**
     * @ORM\ManyToOne(targetEntity=Lots::class, inversedBy="amenagements")
     */
    private $lots;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="amenagements")
     */
    private $services;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAmenagement(): ?\DateTimeInterface
    {
        return $this->dateAmenagement;
    }

    public function setDateAmenagement(\DateTimeInterface $dateAmenagement): self
    {
        $this->dateAmenagement = $dateAmenagement;

        return $this;
    }

    public function getLots(): ?Lots
    {
        return $this->lots;
    }

    public function setLots(?Lots $lots): self
    {
        $this->lots = $lots;

        return $this;
    }

    public function getServices(): ?Services
    {
        return $this->services;
    }

    public function setServices(?Services $services): self
    {
        $this->services = $services;

        return $this;
    }
}
