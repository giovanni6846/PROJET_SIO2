<?php

use App\Modele\Modele_Utilisateur;
use App\Modele\Modele_Ville;
use App\Vue\Vue_Structure_Entete_Connexion;
use App\Vue\Vue_Connexion_Formulaire_client;
use App\Entity\Mission;
use App\Utilitaire\Vue;
global $entityManager;
$utilisateur = \App\Modele\Modele_Utilisateur::utilisateur($_SESSION['id']);
if ($utilisateur->getRole() == 3){
    $idVille = $_POST['id'];
    $email = $_POST['email'];
    $telephone = $_POST['num_tel'];
    $ville = Modele_Ville::findVille($idVille);
    $utilisateur->setVille($ville);
    $utilisateur->setEmail($email);
    $utilisateur->setNumTel($telephone);
    $entityManager->persist($utilisateur);
    $entityManager->flush();
    $ville = \App\Modele\Modele_Ville::ville();
    $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_Utilisateur());
    $Vue->addToCorps(new \App\Vue\Vue_Utilisateur($utilisateur, $ville));
}elseif ($utilisateur->getRole() == 1){
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['num_tel'];
    $idVille = $_POST['ville_id'];
    $mdp = $_POST['mot_de_passe'];
    $role = $_POST['role'];
    $Ville = Modele_Ville::findVille($idVille);
    $utilisateur = \App\Modele\Modele_Utilisateur::utilisateur($id);
    $utilisateur->setNom($nom);
    $utilisateur->setPrenom($prenom);
    $utilisateur->setEmail($email);
    $utilisateur->setNumTel($telephone);
    $utilisateur->setVille($Ville);
    $utilisateur->setMdp($mdp);
    $utilisateur->setRole($role);
    $entityManager->persist($utilisateur);
    $entityManager->flush();
    $utilisateurs = Modele_Utilisateur::utilisateurs();
    $ville = Modele_Ville::ville();
    $Vue->setEntete(new \App\Vue\Vue_Structure_Entete_gestion_utilisateurs());
    $Vue->addToCorps(new \App\Vue\Vue_gestion_utilisateurs("",$utilisateurs, $ville));
}
