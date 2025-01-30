<?php

use App\Entity\Hebergement;
global $entityManager;

$mission = $_POST["mission"];
$nom_hebergement = $_POST["nom_hotel"];
$image = $_FILES["image"]["tmp_name"];
$nbr_nuit = $_POST["nbr_nuit"];

$mission = \App\Modele\Modele_Mission::mission_search($mission);
$find_hebergement = \App\Modele\Modele_Hebergement::search($_POST["nom_hotel"]);
if ($find_hebergement != NULL) {
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
                $mission->setHebergement($find_hebergement);
                $mission->setNbNuit((int)$nbr_nuit);
                $mission->setJustificatif($chemin_image);
                $entityManager->persist($mission);
                $entityManager->flush();
            }
        }
    }
}else{
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
                $hebergement = new Hebergement($nom_hebergement);
                $mission->setHebergement($hebergement);
                $mission->setNbNuit((int)$nbr_nuit);
                $mission->setJustificatif($chemin_image);
                $entityManager->persist($mission);
                $entityManager->flush();
                $entityManager->persist($hebergement);
                $entityManager->flush();
            }
        }
    }
}
$justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
$Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
$Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission,$justificatif));