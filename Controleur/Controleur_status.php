<?php

use App\Entity\Mission;
use App\Utilitaire\Vue;
use App\Vue\Vue_Structure_Entete_Connexion;
use App\Vue\Vue_Connexion_Formulaire_client;

global $entityManager;

$mission = \App\Modele\Modele_Mission::mission_search($_POST['mission']);
$mission->setStatus("A-Validé");
$entityManager->persist($mission);
$entityManager->flush();
$justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
$Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
$Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission,$justificatif));
