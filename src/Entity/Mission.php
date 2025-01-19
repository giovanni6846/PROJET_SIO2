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
#[Table(name: 'Mission')]
class Mission
{

    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(type: 'integer')]
    private int $id;

    #[Column(type: 'string', length: 100)]
    private string $nom_mission;

    #[Column(type: 'date')]
    private datetime $date_debut;

    #[Column(type: 'date')]
    private datetime $date_fin;

    #[Column(type: 'integer')]
    private int $nb_repas;

    #[Column(type: 'integer')]
    private int $nb_nuit;

    #[ManyToOne(targetEntity: Ville::class, inversedBy: 'ville')]
    private Ville $ville;

    #[ManyToOne(targetEntity: Employe::class, inversedBy: 'employe')]
    private Employe $employe;

    #[ManyToOne(targetEntity: Hebergement::class, inversedBy: 'hebergement', cascade: ["persist", "remove"])]
    private ?Hebergement $hebergement;

    #[OneToMany(targetEntity: Deplacer::class, mappedBy: 'mission', indexBy: 'id', cascade: ["persist", "remove"])]
    private Collection $deplacement;

    #[Column(type: 'string', length: 200, nullable: true)]
    private $justificatif = null;

    #[Column(type: 'string', length: 20)]
    private string $status;

    public function __construct(string $nom_mission, datetime $date_debut, datetime $date_fin , int $nb_repas, int $nb_nuit,  Ville $ville , Employe $employe, ?Hebergement $hebergement, string $justificatif,string $status)
    {
        $this->nom_mission = $nom_mission;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->nb_repas = $nb_repas;
        $this->nb_nuit = $nb_nuit;
        $this->ville = $ville;
        $this->employe = $employe;
        $this->hebergement = $hebergement;
        $this->deplacement = new ArrayCollection();
        $this->justificatif = $justificatif;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNomMission(): string
    {
        return $this->nom_mission;
    }

    public function setNomMission(string $nom_mission): void
    {
        $this->nom_mission = $nom_mission;
    }

    public function getDateDebut(): datetime
    {
        return $this->date_debut;
    }

    public function setDateDebut(datetime $date_debut): void
    {
        $this->date_debut = $date_debut;
    }

    public function getDateFin(): datetime
    {
        return $this->date_fin;
    }

    public function setDateFin(datetime $date_fin): void
    {
        $this->date_fin = $date_fin;
    }

    public function getNbRepas(): int
    {
        return $this->nb_repas;
    }

    public function setNbRepas(int $nb_repas): void
    {
        $this->nb_repas = $nb_repas;
    }

    public function getNbNuit(): int
    {
        return $this->nb_nuit;
    }

    public function setNbNuit(?int $nb_nuit): void
    {
        $this->nb_nuit = $nb_nuit;
    }

    public function getVille(): Ville
    {
        return $this->ville;
    }

    public function setVille(Ville $ville): void
    {
        $this->ville = $ville;
    }

    public function getEmploye(): Employe
    {
        return $this->employe;
    }

    public function setEmploye(Employe $employe): void
    {
        $this->employe = $employe;
    }

    public function getHebergement(): ?Hebergement
    {
        return $this->hebergement;
    }

    public function setHebergement(?Hebergement $hebergement): void
    {
        $this->hebergement = $hebergement;
    }

    public function addDeplacement(Deplacer $deplacer): void
    {
        if (!$this->deplacement->contains($deplacer)) {
            $this->deplacement[] = $deplacer;
            $deplacer->setMission($this);
        }
    }

    public function getDeplacement(): array
    {
        return $this->deplacement->toArray();
    }

    public function getJustificatif(): string
    {
        return $this->justificatif;
    }

    public function setJustificatif(string $justificatif): void
    {
        $this->justificatif = $justificatif;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}