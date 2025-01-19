<?php

use App\Vue\Vue_Structure_Entete_Menu;
use App\Vue\Vue_Menu_Principale;
use App\Vue\Vue_Menu_Principale1;
use App\Vue\Vue_Menu_Principale2;

if ($_SESSION['role'] == 3){
    $Vue->setEntete(new Vue_Structure_Entete_Menu());
    $Vue->addToCorps(new Vue_Menu_Principale());
}elseif ($_SESSION['role'] == 2){
    $Vue->setEntete(new Vue_Structure_Entete_Menu());
    $Vue->addToCorps(new Vue_Menu_Principale2());
}elseif ($_SESSION['role'] == 1){
    $Vue->setEntete(new Vue_Structure_Entete_Menu());
    $Vue->addToCorps(new Vue_Menu_Principale1());
}

