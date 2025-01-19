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

    public function __construct(string $nom_mission)
    {
      $this->nom_hotel = $nom_mission;
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
}