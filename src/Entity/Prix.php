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

#[Entity]
#[Table(name: 'Prix')]
class Prix
{

    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(type: 'integer')]
    #[OneToMany(targetEntity: Mission::class, mappedBy: 'mission', indexBy: 'id', cascade: ["persist", "remove"])]
    private int $id;

    #[Column(type: 'string', length: 100)]
    private string $designation;

    #[Column(type: 'string', length: 100)]
    private string $type_tarif;

    #[Column(type: 'float')]
    private string $montant;

    public function __construct(string $designation, string $type_tarif, string $montant)
    {
        $this->designation = $designation;
        $this->type_tarif = $type_tarif;
        $this->montant = $montant;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDesignation(): string
    {
        return $this->designation;
    }

    public function getTypeTarif(): string
    {
        return $this->type_tarif;
    }

    public function getMontant(): string
    {
        return $this->montant;
    }

    public function setDesignation(string $designation): void
    {
        $this->designation = $designation;
    }

    public function setTypeTarif(string $type_tarif): void
    {
        $this->type_tarif = $type_tarif;
    }

    public function setMontant(string $montant): void
    {
        $this->montant = $montant;
    }
}