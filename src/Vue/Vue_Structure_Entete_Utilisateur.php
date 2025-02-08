<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Structure_Entete_Utilisateur  extends Vue_Composant
{
    function donneTexte(): string
    {
        return "<html>
        <head>
           <meta charset='utf-8'>
            <!-- importer le fichier de style -->
            <link rel='stylesheet' href='.\public\Styles_CSS\style_utilisateur.css' media='screen' type='text/css' />
            <script src='.\public\Javascripts\Script_Vue_Selection_Ville.js' defer></script>
        </head>";
    }
}