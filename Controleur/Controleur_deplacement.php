<?php

use App\Entity\Deplacer;
use App\Entity\Transport;
use App\Entity\Mission;
global $entityManager;

$mission = $_POST["mission"];
if (isset($_POST["transport"])){
    $transport = $_POST["transport"];
    $transport = \App\Modele\Modele_Transport::ajout_transport($transport);
    $mission = \App\Modele\Modele_Mission::mission_search($mission);
    if ($transport->getLibelleTransport() == "Tram" || "Avion" || "Train") {
        $cout = $transport->getPrix()->getMontant();
    }

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Informations sur le fichier téléchargé
        $image = $_FILES['image'];
        $nom_image = $image['name'];
        $tmp_image = $image['tmp_name'];
        $type_image = $image['type'];
        $taille_image = $image['size'];

        // Dossier où stocker l'image
        $dossier_upload = 'public\justificatif\ ';  // Assurez-vous que ce dossier existe sur votre serveur
        $chemin_image = $dossier_upload . basename($nom_image);

        // Vérifier le type de fichier (optionnel, mais recommandé pour la sécurité)
        $extensions_autorisees = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($type_image, $extensions_autorisees)) {
            // Déplacer le fichier dans le dossier de téléchargement
            if (move_uploaded_file($tmp_image, $chemin_image)) {
                $deplacement = new \App\Entity\Deplacer($mission, $transport, $cout, $chemin_image);
                $entityManager->persist($deplacement);
                $entityManager->flush();
            }
        }
    }
} elseif (isset($_POST["voiture"])){
    $voiture = $_POST["voiture"];
    $km = $_POST["kilometers"];
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Informations sur le fichier téléchargé
        $image = $_FILES['image'];
        $nom_image = $image['name'];
        $tmp_image = $image['tmp_name'];
        $type_image = $image['type'];
        $taille_image = $image['size'];

        // Dossier où stocker l'image
        $dossier_upload = 'public\justificatif\ ';  // Assurez-vous que ce dossier existe sur votre serveur
        $chemin_image = $dossier_upload . basename($nom_image);

        // Vérifier le type de fichier (optionnel, mais recommandé pour la sécurité)
        $extensions_autorisees = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($type_image, $extensions_autorisees)) {
            // Déplacer le fichier dans le dossier de téléchargement
            if (move_uploaded_file($tmp_image, $chemin_image)) {
                $voiture = \App\Modele\Modele_Transport::ajout_transport($voiture);
                $mission = \App\Modele\Modele_Mission::mission_search($mission);
                $cout = $voiture->getVoiture()->getCoeffKm() * $km;
                $deplacement = new Deplacer($mission, $voiture, $cout, $chemin_image);
                $entityManager->persist($deplacement);
                $entityManager->flush();
            }
        }
    }
} elseif (!isset($_POST["voiture"])){}
$justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
$Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
$Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission,$justificatif));