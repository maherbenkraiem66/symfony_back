<?php

namespace App\Entity;

use App\Repository\PTSRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PTSRepository::class)
 */
class PTS
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $logitude;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $altitude;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="pts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogitude(): ?float
    {
        return $this->logitude;
    }

    public function setLogitude(float $logitude): self
    {
        $this->logitude = $logitude;

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

    public function getAltitude(): ?float
    {
        return $this->altitude;
    }

    public function setAltitude(float $altitude): self
    {
        $this->altitude = $altitude;

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
