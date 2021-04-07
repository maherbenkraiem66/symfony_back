<?php

namespace App\Entity;

use App\Repository\DemandeInstallationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DemandeInstallationRepository::class)
 */
class DemandeInstallation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"default"})
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"default"})
     */
    private $longitude;

    /**
     * @ORM\Column(type="float")
     * @Groups({"default"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="date")
     * @Groups({"default"})
     */
    private $Date;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="DemandeInstallation")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"default"})
     */
    private $Utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="pts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"default"})
     */
    private $region;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }
    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }


}
