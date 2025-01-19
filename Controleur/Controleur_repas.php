<?php


use App\Entity\Mission;

global $entityManager;

$mission = $_POST["mission"];
$repas = $_POST["repas"];
$mission = \App\Modele\Modele_Mission::mission_search($mission);
$mission->setNbRepas((int)$repas);
$entityManager->persist($mission);
$entityManager->flush();
$justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
$Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
$Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission,$justificatif));

