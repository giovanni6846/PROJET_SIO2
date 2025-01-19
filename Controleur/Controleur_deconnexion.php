<?php

use App\Entity\Mission;
use App\Utilitaire\Vue;
use App\Vue\Vue_Structure_Entete_Connexion;
use App\Vue\Vue_Connexion_Formulaire_client;
use App\Vue\Vue_Structure_Entete_TDB;
use App\Vue\Vue_Tableau_de_Bord;

unset($_SESSION);
session_destroy();
echo"detruit";
include "Controleur/Controleur_visiteur.php";