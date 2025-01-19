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
#[Table(name: 'Deplacer')]
class Deplacer
{
    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(type: 'integer')]
    private int $id;

    #[ManyToOne(targetEntity: Mission::class, inversedBy: 'deplacements')]
    private ?Mission $mission = null;

    #[ManyToOne(targetEntity: Transport::class, inversedBy: 'deplacements')]
    private ?Transport $transport = null;

    #[Column(type: 'float')]
    private float $cout;

    #[Column(type: 'string', length: 200,nullable: true)]
    private $justificatif = null;

    public function __construct(?Mission $mission, ?Transport $transport, float $cout, string $justificatif)
    {
        $this->mission = $mission;
        $this->transport = $transport;
        $this->cout = $cout;
        $this->justificatif = $justificatif;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): void
    {
        $this->mission = $mission;
    }

    public function getTransport(): ?Transport
    {
        return $this->transport;
    }

    public function setTransport(?Transport $transport): void
    {
        $this->transport = $transport;
    }

    public function getCout(): float
    {
        return $this->cout;
    }

    public function setCout(float $cout): void
    {
        $this->cout = $cout;
    }

    public function getJustificatif(): string
    {
        return $this->justificatif ?? '';
    }

    public function setJustificatif(string $justificatif): void
    {
        $this->justificatif = $justificatif;
    }
}
