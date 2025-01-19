<?php

use App\Entity\Hebergement;
global $entityManager;

$mission = $_POST["mission"];
$mission = \App\Modele\Modele_Mission::mission_search($mission);
$mission->setStatus("Rejeter");
$entityManager->persist($mission);
$entityManager->flush();
$to = htmlspecialchars($mission->getEmploye()->getEmail());  // Remplacez par l'email du destinataire
$subject = htmlspecialchars("Rejet note de frais: " . $mission->getNomMission());
$message = htmlspecialchars("La note de frais : " . $mission->getNomMission() . " a été rejeter par la comptabilité le : " . date('d/m/Y à H:i:s') . "\r\n" );
$headers = "From: " . htmlspecialchars("giovanni6846@gmail.com") . "\r\n";

// Envoi de l'email
if (mail($to, $subject, $message, $headers)) {
    $msg_erreur = "Email envoyé avec succès!";
} else {
    $msg_erreur = "Erreur lors de l'envoi de l'email.";
}

$justificatif = \App\Modele\Modele_Mission::mission_justificatif($mission->getId());
$Vue->setEntete(new \App\Vue\Vue_Structure_Entete_TDB());
$Vue->addToCorps(new \App\Vue\Vue_Tableau_de_Bord($mission,$justificatif,$msg_erreur));