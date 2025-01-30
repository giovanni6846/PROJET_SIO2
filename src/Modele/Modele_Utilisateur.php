<?php

namespace App\Modele;

global $entityManager;
include_once "vendor/autoload.php";
include_once "bootstrap.php";

use App\Entity\Employe;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

class Modele_Utilisateur
{

    public static function connexion($pseudo, $mdp)
    {
        global $entityManager;
        $identifiant = $entityManager->getRepository(Employe::class)->findOneBy(['prenom' => $pseudo, 'mdp' => $mdp]);
        if ($identifiant == NULL)
        {
            return false;
        }
        else
        {
            $_SESSION['id'] = $identifiant->getId();
            $_SESSION['typeConnexionBack'] = "connecter";
            $_SESSION['role'] = $identifiant->getRole();
            return true;
        }
    }
    public static function utilisateur($id)
    {
        global $entityManager;
        return $entityManager->getRepository(Employe::class)->findOneBy(['id' => $id]);
    }

    public static function utilisateurs()
    {
        global $entityManager;
        return $entityManager->getRepository(Employe::class)->findAll();
    }
}