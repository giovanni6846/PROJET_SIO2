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
#[ORM\Table(name: 'Transport')]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $libelle_transport;

    #[ORM\OneToOne(targetEntity: Voiture::class, mappedBy: 'transport', cascade: ["persist", "remove"], fetch:"EAGER")]
    private ?Voiture $voiture = null;

    #[ORM\OneToMany(targetEntity: Deplacer::class, mappedBy: 'transport', cascade: ["persist", "remove"])]
    private Collection $deplacements;

    public function __construct(string $libelle_transport, ?Voiture $voiture = null)
    {
        $this->libelle_transport = $libelle_transport;
        $this->voiture = $voiture;
        $this->deplacements = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLibelleTransport(): string
    {
        return $this->libelle_transport;
    }

    public function setLibelleTransport(string $libelle_transport): void
    {
        $this->libelle_transport = $libelle_transport;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): void
    {
        $this->voiture = $voiture;
    }

    public function getDeplacements(): Collection
    {
        return $this->deplacements;
    }

    public function addDeplacement(Deplacer $deplacer): void
    {
        if (!$this->deplacements->contains($deplacer)) {
            $this->deplacements[] = $deplacer;
            $deplacer->setTransport($this);
        }
    }

    public function removeDeplacement(Deplacer $deplacer): void
    {
        if ($this->deplacements->contains($deplacer)) {
            $this->deplacements->removeElement($deplacer);
            if ($deplacer->getTransport() === $this) {
                $deplacer->setTransport(null);
            }
        }
    }
}

