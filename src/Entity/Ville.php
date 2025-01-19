<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'Ville')]
class Ville
{
    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(type: 'integer')]
    #[OneToMany(targetEntity: Employe::class, mappedBy: 'ville', indexBy: 'id', cascade: ["persist", "remove"])]
    private int $id;

    #[Column(type: 'string', length: 100)]
    private string $cp_ville;

    #[Column(type: 'string', length: 100)]
    private string $nom_ville;

    public function __construct(string $cp_ville, string $nom_ville)
    {
        $this->cp_ville = $cp_ville;
        $this->nom_ville = $nom_ville;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCpVille(): string
    {
        return $this->cp_ville;
    }

    public function getNomVille(): string
    {
        return $this->nom_ville;
    }

    public function setCpVille(string $cp_ville): Void
    {
        $this->cp_ville = $cp_ville;
    }

    public function setNomVille(string $nom_ville): Void
    {
        $this->nom_ville = $nom_ville;
    }
}