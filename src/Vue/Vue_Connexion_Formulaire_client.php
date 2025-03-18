<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Connexion_Formulaire_client extends Vue_Composant
{
    private string $msgErreur;

    public function __construct(string $msgErreur = "")
    {
        $this->msgErreur = $msgErreur;
    }

    function donneTexte(): string
    {
        $str = "
        <h1 class='ntf'>Note de frais</h1>
        <div class='container'>
            <div class='left-section'>
                <img src='public/image/notedefrais.png' alt='note de frais'>
            </div>
            <div class='right-section'>
                <form action='index.php' method='post'>
                    <h1>Connexion</h1>
                    
                    <label><b>Compte</b></label>
                    <input type='text' placeholder='identifiant du compte' name='pseudo' required>

                    <label><b>Mot de passe</b></label>
                    <input type='password' placeholder='mot de passe' name='motdepasse' required>
                    
                    <button type='submit' id='submit' name='action' value='Se connecter'>
                        Se connecter
                    </button>";

        if ($this->msgErreur != "") {
            $str .= "<label><b style='color:red;'>Erreur : " . htmlspecialchars($this->msgErreur) . "</b></label>";
        }

        $str .= "
                </form>
                <form>
                    <h1>Mot de passe perdu ?</h1>
                    <button type='submit' id='submit' name='action' value='reinitmdp'>
                        Réinitialiser le mdp
                    </button>
                </form>
            </div>
        </div>";

        return $str;
    }
}
