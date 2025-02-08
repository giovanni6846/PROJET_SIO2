<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Structure_Entete_Saisie_Frais  extends Vue_Composant
{
    public function __construct()
    {
    }

    function donneTexte(): string
    {


        return "<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Saisir Hébergement</title>
    <link rel='stylesheet' href='.\public\Styles_CSS\style_entete_saisie_frais.css'>
    <script src='.\public\Javascripts\Script_Vue_Saisie_Frais.js' defer></script>
</head>";
    }
}