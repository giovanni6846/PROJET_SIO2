<?php

global $entityManager;
include_once "bootstrap.php";
use App\Entity\Employe;
use App\Modele\Modele_Utilisateur;
use App\Modele\Modele_Ville;
use App\Vue\Vue_Structure_Entete_Connexion;
use App\Vue\Vue_Connexion_Formulaire_client;
use App\Entity\Mission;
use App\Utilitaire\Vue;

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['mot_de_passe'];
    $role = $_POST['role'];
    $employe = New Employe($nom,$prenom,"",null,$mdp,"",$role);
    $entityManager->persist($employe);
    $entityManager->flush();
    $utilisateurs = Modele_Utilisateur::utilisateurs();
    $ville = \App\Modele\Modele_Ville::ville();
    $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_gestion_utilisateurs());
    $Vue->addToCorps(new \App\Vue\Vue_gestion_utilisateurs("",$utilisateurs, $ville));