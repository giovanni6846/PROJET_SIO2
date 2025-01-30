<?php

namespace App\Modele;

global $entityManager;
include_once "vendor/autoload.php";
include_once "bootstrap.php";

use App\Entity\Deplacer;
use App\Entity\Employe;
use App\Entity\Mission;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use App\Entity\Ville;

class Modele_Ville
{
    public static function ville()
    {
        global $entityManager;
        $ville = $entityManager->getRepository(Ville::class)->findAll();
        return $ville;
    }

    public static function findVille($idVille)
    {
        global $entityManager;
        $ville = $entityManager->getRepository(Ville::class)->findBy(["id" => $idVille]);
        return $ville[0];
    }
}