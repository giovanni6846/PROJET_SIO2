<?php

use App\Entity\Hebergement;
use App\Entity\Mission;
global $entityManager;


if (isset($_POST["mission"]))
{
    $mission = \App\Modele\Modele_Mission::ajouter($_POST["mission"],$_POST["destination"],$_POST["date-debut"],$_POST["date-fin"], $_SESSION["id"]);
    $justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
    $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
    $Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission,$justificatif));
}else{
    $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_Ajouter_NDF());
    $Vue->addToCorps(new \App\Vue\Vue_Ajouter_NDF());
}
