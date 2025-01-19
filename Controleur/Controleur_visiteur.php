<?php

use App\Vue\Vue_Structure_Entete_Connexion;
use App\Vue\Vue_Connexion_Formulaire_client;


switch ($action) {
    case 'Se connecter':
        $data = \App\Modele\Modele_Utilisateur::connexion($_POST["pseudo"], $_POST["motdepasse"]);
        if ($data != null) {
            include_once "Controleur_connecter.php";
            } else {
            $Vue->setEntete(new Vue_Structure_Entete_Connexion());
            $Vue->addToCorps(new \App\Vue\Vue_Connexion_Formulaire_client("Mot de passe incorrect"));
        }
        break;
    default:
       $Vue->setEntete(new Vue_Structure_Entete_Connexion());
       $Vue->addToCorps(new Vue_Connexion_Formulaire_client());
    break;
}
