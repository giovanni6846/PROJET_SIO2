<?php

use App\Entity\Hebergement;
use App\Entity\Mission;
global $entityManager;

if(isset($_POST["deplacement_id"])){
    $mission = $_POST["mission"];
    $mission = \App\Modele\Modele_Mission::mission_search($mission);
    $deplacement = \App\Modele\Modele_Deplacement::deplacementMission($_POST["deplacement_id"]);
    $entityManager->remove($deplacement);
    $entityManager->flush();
    $justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
    $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
    $Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission,$justificatif,$_POST["msg_delete"]));
} else {
    $mission = $_POST["mission"];
    $mission = \App\Modele\Modele_Mission::mission_search($mission);
    $mission->setHebergement( NULL);
    $mission->setNbNuit( 0);
    $mission->setJustificatif( "");
    $entityManager->persist($mission);
    $entityManager->flush();
    $justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
    $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
    $Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission, $justificatif,"Hebergement supprimer"));
}
