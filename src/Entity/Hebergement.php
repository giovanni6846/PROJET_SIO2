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
#[Table(name: 'Hebergement')]
class Hebergement
{

    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(type: 'integer')]
    #[OneToMany(targetEntity: Mission::class, mappedBy: 'mission', indexBy: 'id', cascade: ["persist", "remove"])]
    private int $id;

    #[Column(type: 'string', length: 100)]
    private string $nom_hotel;

    #[ManyToOne(targetEntity: Prix::class, inversedBy: 'prix', cascade: ["persist", "remove"])]
    private Prix $prix;

    public function __construct(string $nom_mission, Prix $prix)
    {
      $this->nom_hotel = $nom_mission;
      $this->prix = $prix;
    }

    public function getId(): int
    {
        return $this->id;
    }

   public function getNomHotel(): string
   {
       return $this->nom_hotel;
   }

    public function setNomHotel(string $nom_hotel): void
    {
        $this->nom_hotel = $nom_hotel;
    }

    public function getPrix(): Prix
    {
        return $this->prix;
    }

    public function setPrix(Prix $prix): void
    {
        $this->prix = $prix;
    }
}