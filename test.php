<?php

global $entityManager;
include_once "vendor/autoload.php";
include_once "bootstrap.php";

use App\Entity\Employe;
use APP\Entity\Ville;
use APP\Entity\Mission;
use App\Entity\Hebergement;


$utilisateur = New Employe("Test","Test","",null,"","",1);
$entityManager->persist($utilisateur);
$entityManager->flush();
