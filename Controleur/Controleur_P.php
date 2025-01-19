<?php

use App\Entity\Mission;
use App\Utilitaire\Vue;
use App\Vue\Vue_Structure_Entete_Connexion;
use App\Vue\Vue_Connexion_Formulaire_client;
use App\Vue\Vue_Structure_Entete_TDB;
use App\Vue\Vue_Tableau_de_Bord;


$mission = \App\Modele\Modele_Mission::mission_P($_POST['mission'],$_SESSION['role']);
if ($mission != NULL) {
    $justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
    $Vue->setEntete(new Vue_Structure_Entete_TDB());
    $Vue->addToCorps(new Vue_Tableau_de_Bord($mission,$justificatif));
}else{
    $msg_erreur = "Aucune Note de frais précedente";
    $mission_first = \App\Modele\Modele_Mission::mission_first($_SESSION['role']);
    include_once "Controleur_TDB.php";
}