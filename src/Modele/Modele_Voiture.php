<?php

namespace App\Modele;

global $entityManager;
include_once "vendor/autoload.php";
include_once "bootstrap.php";

use App\Entity\Employe;
use App\Entity\Hebergement;
use App\Entity\Mission;
use App\Entity\Voiture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
class Modele_Voiture
{
    public static function search($id)
    {
        global $entityManager;
        $voiture = $entityManager->getRepository(Voiture::class)->findBy(['id' => $id]);
        return $voiture[0];
    }
}