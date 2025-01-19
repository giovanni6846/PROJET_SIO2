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

class Modele_Deplacement
{
    public static function deplacement($mission)
    {
        global $entityManager;
        $deplacement = $entityManager->getRepository(Deplacer::class)->findBy([
            'mission' => $mission
        ]);
        if ($deplacement == null) {
            return False;
        } else {
            return $deplacement;
        }
    }

    public static function deplacementMission($id)
    {
        global $entityManager;
        $deplacement = $entityManager->getRepository(Deplacer::class)->findBy(['id' => $id]);
        if ($deplacement == null) {
            return False;
        }else{
            return $deplacement[0];
        }
    }
}