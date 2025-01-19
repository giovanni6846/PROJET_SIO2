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
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'Employe')]
class Employe
{

    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(type: 'integer')]
    #[OneToMany(targetEntity: Employe::class, mappedBy: 'mission', indexBy: 'id', cascade: ["persist", "remove"])]
    private int $id;

    #[Column(type: 'string', length: 100)]
    private string $nom;

    #[Column(type: 'string', length: 100)]
    private string $prenom;

    #[Column(type: 'string', length: 15, nullable: true)]
    private string $num_tel;

   #[ManyToOne(targetEntity: Ville::class, inversedBy: 'ville')]
   private Ville $ville;

    #[Column(type: 'string', length: 15)]
    private string $mdp;

    #[Column(type: 'string', length: 50, nullable: true)]
    private string $email;

    #[Column(type: 'integer')]
    private int $role;

    public function __construct(string $nom, string $prenom, string $num_tel , Ville $ville,  string $mdp , string $email, int $role )
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->num_tel = $num_tel;
        $this->ville = $ville;
        $this->mdp = $mdp;
        $this->email = $email;
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getVille(): Ville
    {
        return $this->ville;
    }

    public function setVille(Ville $ville): void
    {
        $this->ville = $ville;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getNumTel(): ?string
    {
        return $this->num_tel;
    }

    public function setNumTel(?string $num_tel): void
    {
        $this->num_tel = $num_tel;
    }

    public function getMotdepasse(): string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $mdp): void
    {
        $this->motdepasse = $mdp;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): void
    {
        $this->role = $role;
    }
}