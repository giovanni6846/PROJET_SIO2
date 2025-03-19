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
<body>

    <header>
        <h1>Gestion des Notes de Frais</h1>
    </header>
    <!-- Menu en grand format avec animation -->
    <div class='menu-container'>
        <div class='menu-item' data-text='Tableau de Bord' style='background-image: url('public/image/TDB.png');'>
            <div class='menu-content'>
                <img src='public/image/TDB.png' alt='Tableau de Bord' class='menu-image'>
                <a class='menu-text' href='index.php?action=mission'>Tableau de Bord</p>
            </div>
        </div>
        <div class='menu-item' data-text='Ajouter une Note de Frais' style='background-image: url('public/image/ANDF.png');'>
            <div class='menu-content'>
                <img src='public/image/ANDF.png' alt='Ajouter une Note de Frais' class='menu-image'>
                <a class='menu-text' href='index.php?action=ajouter_NDF'>Ajouter une Note de Frais</p>
            </div>
        </div>
        <div class='menu-item' data-text='Mon Espace' style='background-image: url('public/image/ME.png');'>
            <div class='menu-content'>
                <img src='public/image/ME.png' alt='Mon Espace' class='menu-image'>
                <a class='menu-text' href='index.php?action=mon_espace'>Mon Espace</p>
            </div>
        </div>
        <div class='menu-item' data-text='Se Déconnecter' style='background-image: url('public/image/SD.jpg');'>
            <div class='menu-content'>
                <img src='public/image/SD.jpg' alt='Se Déconnecter' class='menu-image'>
                <a class='menu-text' href='index.php?action=deconnexion'>Se Déconnecter</p>
            </div>
        </div>
    </div>

    <!-- Footer avec copyright -->
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