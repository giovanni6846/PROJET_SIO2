<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Voiture')]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'integer')]
    private int $nb_chevaux;

    #[ORM\Column(type: 'float')]
    private float $coeff_km;

    #[ORM\OneToOne(targetEntity: Transport::class, inversedBy: 'voiture', cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(name: 'transport_id', referencedColumnName: 'id', nullable: false)]
    private ?Transport $transport = null;

    public function __construct(float $coeff_km, int $nb_chevaux, ?Transport $transport = null)
    {
        $this->coeff_km = $coeff_km;
        $this->nb_chevaux = $nb_chevaux;
        $this->transport = $transport;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNbChevaux(): int
    {
        return $this->nb_chevaux;
    }

    public function getCoeffKm(): float
    {
        return $this->coeff_km;
    }

    public function getTransport(): ?Transport
    {
        return $this->transport;
    }

    public function setTransport(?Transport $transport): void
    {
        $this->transport = $transport;
    }
}

