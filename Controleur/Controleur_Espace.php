<?php

use App\Vue\Vue_Structure_Entete_Connexion;
use App\Vue\Vue_Connexion_Formulaire_client;
use App\Entity\Mission;
use App\Utilitaire\Vue;

$utilisateur = \App\Modele\Modele_Utilisateur::utilisateur();
$ville = \App\Modele\Modele_Ville::ville();
$Vue->setEntete(new \App\Vue\Vue_Structure_Entete_Utilisateur());
$Vue->addToCorps(new \App\Vue\Vue_Utilisateur($utilisateur, $ville));

