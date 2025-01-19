<?php

$id = $_POST["mission"];
$mission = \App\Modele\Modele_Mission::mission_search($id);
$deplacement = \App\Modele\Modele_Deplacement::deplacement($id);
foreach ($deplacement as $deplacements) {
    $mission->addDeplacement($deplacements);
}

$Vue->setEntete(new \App\Vue\Vue_Structure_Entete_Suppression());
$Vue->addToCorps(new \App\Vue\Vue_Suppression($mission));