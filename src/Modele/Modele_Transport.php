<?php

namespace App\Modele;

global $entityManager;
include_once "vendor/autoload.php";
include_once "bootstrap.php";

use App\Entity\Deplacer;
use App\Entity\Employe;
use App\Entity\Mission;
use App\Entity\Voiture;
use App\Entity\Transport;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

class Modele_Transport
{
    public static function transport()
    {
        global $entityManager;
        $transport = $entityManager->getRepository(Transport::class)->findAll();
        if ($transport == null) {
            return False;
        } else {
            return $transport;
        }
    }

    public static function cout_transport($deplacement){
        global $entityManager;
        $content = 0;
            if ($deplacement->getTransport()->getLibelleTransport() == "Avion"){
                $content =  $deplacement->getCout() ;
            }elseif ($deplacement->getTransport()->getLibelleTransport() == "TGV"){
                $content =  $deplacement->getCout() ;
            }elseif ($deplacement->getTransport()->getLibelleTransport() == "Tram"){
                $content =  5 ;
            }elseif ($deplacement->getTransport()->getVoiture() != null){
                $content =  $deplacement->getCout() ;
            }
        return $content;
    }

    public static function ajout_transport($id)
    {
        global $entityManager;
        $transport = $entityManager->getRepository(Transport::class)->findBy(['id' => $id]);
        return $transport[0];
    }
}