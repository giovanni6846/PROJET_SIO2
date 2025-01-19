<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Menu_Principale extends Vue_Composant
{
    private string $msgErreur;
    public function __construct(string $msgErreur ="")
    {
        $this->msgErreur=$msgErreur;
    }

    function donneTexte(): string
    {
        $str= "
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Gestion des Notes de Frais</title>
    <link rel='stylesheet' href='styles.css'>
</head>
<body>

    <!-- Header with the page title -->
    <header>
        <h1>Gestion des Notes de Frais</h1>
    </header>

    <!-- Navigation bar at the top -->
    <nav>
        <a href='index.php?action=mission'>Tableau de Bord</a>
        <a href='index.php?action=ajouter_NDF'>Ajouter une Note de Frais</a>
        <a href='index.php?action=deconnexion'>Se Déconnecter</a>
    </nav>

    <!-- Main container for content -->
    <div class='container'>
        <h2>Bienvenue dans la gestion des notes de frais</h2>
    </div>

    <!-- Footer with copyright or additional information -->
    <footer>
        <p>&copy; 2024 Gestion des Notes de Frais. Tous droits réservés.</p>
    </footer>

</body>
</html>
                " ;
        if($this->msgErreur != "")
        {
            $str .=  " <label><b>Erreur : $this->msgErreur</b></label>";
        }

        $str .= "
</form>
</div>
    ";


        return $str ;
    }
}