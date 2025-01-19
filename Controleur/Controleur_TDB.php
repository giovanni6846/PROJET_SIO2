<?php

use App\Entity\Mission;
use App\Utilitaire\Vue;
use App\Vue\Vue_Structure_Entete_Connexion;
use App\Vue\Vue_Connexion_Formulaire_client;


$mission = \App\Modele\Modele_Mission::mission($_SESSION['role']);

if (!$mission){
    $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_Aucune_Mission());
    $Vue->addToCorps(new \App\Vue\Vue_Aucune_Mission());
}else{
    $deplacement = \App\Modele\Modele_Deplacement::deplacement($mission->getId());
    if ($deplacement != null){
        foreach ($deplacement as $deplacer) {
            $mission->addDeplacement($deplacer);
        }
    }

    if ($msg_erreur == ""){
        if ($mission != NULL) {
            $justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
            $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
            $Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission,$justificatif));
        }
    }else{
        if ($mission_first != NULL) {
            $justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission_first->getId());
            $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
            $Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission_first ,$justificatif,$msg_erreur));
        }elseif ($mission != NULL) {
            $justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
            $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
            $Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission, $justificatif,$msg_erreur));
        }
    }
}

