<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Structure_Entete_TDB extends Vue_Composant
{
    public function __construct()
    {
    }

    function donneTexte(): string
    {
        return "
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Détails de la Mission</title>
    <link rel='stylesheet' href='.\public\Styles_CSS\style_entete_tableau_de_bord.css'>
    <script src='.\public\Javascripts\Script_Vue_Tableau_de_Bord.js' defer></script>
</head>";
    }
}