<?php
//error_log("page debut");
session_start();

include_once "vendor/autoload.php";

use App\Utilitaire\Vue;

$Vue = new Vue();

if (isset($_SESSION["typeConnexionBack"])) {
    $typeConnexion = $_SESSION["typeConnexionBack"];
}else{
    $typeConnexion = "visiteur";
}

if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
}else{
    $action = "";
}

switch ($typeConnexion) {
    case "connecter" :
        switch ($_SESSION["role"]) {
            case "3" :
                switch ($action) {
                    case "mission":
                        $msg_erreur = "";
                        include "Controleur/Controleur_TDB.php";
                        break;
                    case "suivant":
                        include "Controleur/Controleur_S.php";
                        break;
                    case "precedent":
                        include "Controleur/Controleur_P.php";
                        break;
                    case "deconnexion":
                        include "Controleur/Controleur_deconnexion.php";
                        break;
                    case "ajouter":
                        include "Controleur/Controleur_ajouter.php";
                        break;
                    case "supprimer":
                        include "Controleur/Controleur_supprimer.php";
                        break;
                    case "hebergement":
                        include "Controleur/Controleur_hebergement.php";
                        break;
                    case "delete":
                        include "Controleur/Controleur_delete.php";
                        break;
                    case "deplacement":
                        include "Controleur/Controleur_deplacement.php";
                        break;
                    case "repas":
                        include "Controleur/Controleur_repas.php";
                        break;
                    case "ajouter_NDF":
                        include "Controleur/Controleur_ajouter_NDF.php";
                        break;
                    case "status":
                        include "Controleur/Controleur_status.php";
                        break;
                    case "pdf":
                        include "Controleur/Controleur_PDF.php";
                        break;
                    case "mon_espace":
                        include "Controleur/Controleur_Espace.php";
                        break;
                    case "maj_user":
                        include "Controleur/Controleur_maj_user.php";
                        break;
                    default:
                        include "Controleur/Controleur_connecter.php";
                        break;
                }
                break;
            case "2":
                switch ($action) {
                    case "suivant":
                        include "Controleur/Controleur_S.php";
                        break;
                    case "precedent":
                        include "Controleur/Controleur_P.php";
                        break;
                    case "valider":
                        $msg_erreur = "";
                        include "Controleur/Controleur_TDB.php";
                        break;
                    case "deconnexion":
                        include "Controleur/Controleur_deconnexion.php";
                        break;
                    case "accepter":
                        include "Controleur/Controleur_accepter.php";
                        break;
                    case "rejeter";
                        include "Controleur/Controleur_rejeter.php";
                        break;
                    case "pdf":
                        include "Controleur/Controleur_PDF.php";
                        break;
                    default:
                        include "Controleur/Controleur_connecter.php";
                        break;
                }
                break;
            case "1":
                switch ($action) {
                    case "gestion_utilisateurs":
                        include "Controleur/Controleur_gestion_utilisateurs.php";
                        break;
                    case "deconnexion":
                        include "Controleur/Controleur_deconnexion.php";
                        break;
                    case "maj_user":
                        include "Controleur/Controleur_maj_user.php";
                        break;
                    case "create_user":
                        include "Controleur/Controleur_create_user.php";
                        break;
                    default:
                        include "Controleur/Controleur_connecter.php";
                        break;
                }
                break;
        }
    break;
    case "visiteur" :
        include "Controleur/Controleur_visiteur.php";
        break;
}

$Vue->afficher();

