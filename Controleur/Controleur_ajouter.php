<?php

$id = $_POST["mission"];
$mission = \App\Modele\Modele_Mission::mission_search($id);
$transport = \App\Modele\Modele_Transport::transport();
$Vue->setEntete(new \App\Vue\Vue_Structure_Entete_Saisie_Frais());
$Vue->addToCorps(new \App\Vue\Vue_Saisie_Frais($mission, $transport));