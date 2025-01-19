<?php

namespace App\Modele;

global $entityManager;
include_once "vendor/autoload.php";
include_once "bootstrap.php";

use App\Entity\Employe;
use App\Entity\Hebergement;
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
class Modele_Hebergement
{
    public static function ajouter($image, $id ){
        global $entityManager;

    }

    public static function search($nom_hotel)
    {
        global $entityManager;
        $hebergement = $entityManager->getRepository(Hebergement::class)->findAll();
        foreach ($hebergement as $hebergements) {
            if ($hebergements->getNomHotel() == $nom_hotel ) {
                return $hebergements;
            }
        }
    }
}