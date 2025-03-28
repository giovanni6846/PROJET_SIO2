<?php

namespace App\Modele;

global $entityManager;
include_once "vendor/autoload.php";
include_once "bootstrap.php";

use App\Entity\Employe;
use App\Entity\Hebergement;
use App\Entity\Mission;
use App\Entity\Prix;
use App\Entity\Ville;
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

class Modele_Mission
{
    public static function mission($role)
    {
        global $entityManager;
        $mostRecentMission = null;
        $mostRecentDate = null;
        if ($role == 2){
            $missions = $entityManager->getRepository(Mission::class)->findBy([
                'status' => "A-Validé"
            ]);

            if ($missions == null) {
                return False;
            } else {
                foreach ($missions as $mission) {
                    $missionDateDebut = $mission->getDateDebut();
                    if ($mostRecentMission === null || $missionDateDebut > $mostRecentDate) {
                        $mostRecentMission = $mission;
                        $mostRecentDate = $missionDateDebut;
                    }
                }
                return $mostRecentMission;
            }
        }else{
            $missions = $entityManager->getRepository(Mission::class)->findBy([
                'employe' => $_SESSION['id']
            ]);

            if ($missions == null) {
                return False;
            } else {
                foreach ($missions as $mission) {
                    $missionDateDebut = $mission->getDateDebut();
                    if ($mostRecentMission === null || $missionDateDebut > $mostRecentDate) {
                        $mostRecentMission = $mission;
                        $mostRecentDate = $missionDateDebut;
                    }
                }
                return $mostRecentMission;
            }
        }


    }

    public static function mission_S($idMission, $role)
    {
        global $entityManager;
        if ($role == 2){
            $findMission = $entityManager->getRepository(Mission::class)->findBy(['status' => "A-Valider"]);
            if ($findMission == null) {
                return False;
            } else {
                $mission_s = null;
                foreach ($findMission as $mission) {
                    if ($mission->getId() > $idMission) {
                        $mission_s = $mission;
                        break;
                    }
                }
                return $mission_s;
            }
        }else{
            $findMission = $entityManager->getRepository(Mission::class)->findBy(['employe' => $_SESSION['id']]);
            if ($findMission == null) {
                return False;
            } else {
                $mission_s = null;
                foreach ($findMission as $mission) {
                    if ($mission->getId() > $idMission) {
                        $mission_s = $mission;
                        break;
                    }
                }
                return $mission_s;
            }
        }

    }

    public static function mission_P($idMission, $role)
    {
        global $entityManager;
        if ($role == 2){
            $findMission = $entityManager->getRepository(Mission::class)->findBy(['status' => "A-Valider"],['id' => 'DESC']);
            if ($findMission == null) {
                return False;
            } else {
                $mission_p = null;
                foreach ($findMission as $mission) {
                    if ($mission->getId() < $idMission) {
                        $mission_p = $mission;
                        break;
                    }
                }
                return $mission_p;
            }
        }else{
            $findMission = $entityManager->getRepository(Mission::class)->findBy(['employe' => $_SESSION['id']],['id' => 'DESC']);
            if ($findMission == null) {
                return False;
            } else {
                $mission_p = null;
                foreach ($findMission as $mission) {
                    if ($mission->getId() < $idMission) {
                        $mission_p = $mission;
                        break;
                    }
                }
                return $mission_p;
            }
        }

    }

    public static function mission_first($role)
    {
        global $entityManager;
        if ($role == 2){
            $findMission = $entityManager->getRepository(Mission::class)->findBy(['status' => "A-Valider"]);
            if ($findMission == null) {
                return False;
            } else {
                $mission_first = $findMission[0];
            }
            return $mission_first;
        }else{
            $findMission = $entityManager->getRepository(Mission::class)->findBy(['employe' => $_SESSION['id']]);
            if ($findMission == null) {
                return False;
            } else {
                $mission_first = $findMission[0];
            }
            return $mission_first;
        }

    }

    public static function cout($mission){
        global $entityManager;
        $content = 0;
        foreach ($mission->getDeplacement() as $deplacer) {
            if ($deplacer->getTransport()->getLibelleTransport() == "Avion" || "Train" || "Tram"){
                $content = $content + $deplacer->getCout() ;
            }elseif ($deplacer->getTransport()->getVoiture() != null){
                $content = $content + $deplacer->getCout() ;
            }
        }
        return $content;
    }


    public static function mission_a_valider(){
        global $entityManager;
        $mission = $entityManager->getRepository(Mission::class)->findBy(["status" => "A-Valider"]);
        if ($mission == null) {
            return False;
        }else{
            return $mission[0];
        }
    }

    public static function ajouter($mission, $ville, $date_debut, $date_fin, $id){
        global $entityManager;
        if ($date_debut > $date_fin) {
            return False;
        }
        $destination = $entityManager->getRepository(Ville::class)->findBy(['id' => $ville]);
        $employer = $entityManager->getRepository(Employe::class)->find($id);
        $prix_repas = \App\Modele\Modele_Prix::search("Repas");
        $dateDebut = new DateTime($date_debut);
        $dateFin = new DateTime($date_fin);
        $mission = New Mission($mission,$dateDebut,$dateFin,0,0,$destination[0],$employer,null,"","En-Cours",$prix_repas[0]);
        $entityManager->persist($mission);
        $entityManager->flush();
        return $mission;
    }

    public static function mission_search($mission)
    {
        global $entityManager;
        $findMission = $entityManager->getRepository(Mission::class)->findBy(['id' => $mission]);
        if ($findMission == null) {
            return False;
        }
        return $findMission[0];
    }

    public static function mission_justificatif($mission)
    {
        global $entityManager;
        $liste = []; // Initialisation du tableau de résultats

        // Récupération de la mission par son ID
        $justificatif = $entityManager->getRepository(Mission::class)->findBy(['id' => $mission]);

        // Vérifier si la mission existe et récupérer le justificatif de la mission
        if ($justificatif != null) {
            $justificatifsMission = $justificatif[0]->getJustificatif();
            // Ajouter le justificatif de la mission au tableau $liste
            if ($justificatifsMission) {
                $liste[] = [
                    'nom' => 'Mission - ' . $justificatif[0]->getHebergement()->getNomHotel(),
                    'chemin' => $justificatifsMission
                ];
            }
        }

        // Récupérer les justificatifs de chaque déplacement et les ajouter à la liste
        foreach ($justificatif[0]->getDeplacement() as $deplacer) {
            $justificatifsDeplacement = $deplacer->getJustificatif();
            if ($justificatifsDeplacement) {
                $liste[] = [
                    'nom' => 'Déplacement - ' . $deplacer->getTransport()->getLibelleTransport(),
                    'chemin' => $justificatifsDeplacement
                ];
            }
        }

        // Retourner la liste des justificatifs
        return $liste;
    }
}