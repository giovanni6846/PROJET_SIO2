<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Structure_Entete_Aucune_Mission  extends Vue_Composant
{
    public function __construct()
    {
    }

    function donneTexte(): string
    {


        return "<!DOCTYPE html>
        <html lang='fr'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Aucune Mission Disponible</title>
            <link rel='stylesheet' href='.\public\aucune_mission.css'> <!-- Lien vers le fichier CSS -->
        </head>";
    }
}


