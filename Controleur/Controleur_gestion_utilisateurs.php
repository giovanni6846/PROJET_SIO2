<?php

use App\Entity\Mission;
use App\Modele\Modele_Utilisateur;
use App\Modele\Modele_Ville;
use App\Utilitaire\Vue;
use App\Vue\Vue_Structure_Entete_Connexion;
use App\Vue\Vue_Connexion_Formulaire_client;


$utilisateurs = Modele_Utilisateur::utilisateurs();
$ville = Modele_Ville::ville();
$Vue->setEntete(new \App\Vue\Vue_Structure_Entete_gestion_utilisateurs());
$Vue->addToCorps(new \App\Vue\Vue_gestion_utilisateurs("",$utilisateurs));
$Vue->addToCorps(new \App\Vue\Vue_Selection_Ville($ville));



