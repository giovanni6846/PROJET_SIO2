<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Ajouter_NDF extends Vue_Composant
{
    private string $msgErreur;

    public function __construct(string $msgErreur ="")
    {
        $this->msgErreur=$msgErreur;
    }

    function donneTexte(): string
    {
    ob_start(); // Démarre la capture de sortie
    ?>
    <body>
    <header>
        <h1>Ajouter note de frais </h1>
    </header>
    <nav>
        <a href='index.php?action=mission'>Tableau de Bord</a>
        <a href='index.php?action=mon_espace'>Mon Espace</a>
        <a href='index.php?action=deconnexion'>Se Déconnecter</a>
    </nav>
    <div class='form-container'>
        <h2>Ajouter une Note de Frais</h2>
        <form action='index.php' method='post'>
            <div class='form-group'>
                <label for='ville'>Destination de la mission</label>
                <input type='text' id='ville' name='ville' required readonly>
            </div>
            <div class='form-group'>
                <label for='mission'>Nom de la Mission</label>
                <input type='text' id='mission' name='mission' required>
            </div>
            <div class='form-group'>
                <label for='date-debut'>Date de Début</label>
                <input type='date' id='date-debut' name='date-debut' required>
            </div>
            <div class='form-group'>
                <label for='date-fin'>Date de Fin</label>
                <input type='date' id='date-fin' name='date-fin' required>
            </div>
            <div class='form-group'>
                <input type="hidden" name="id" value="">
                <button type='submit' name ='action' value='ajouter_NDF'>Ajouter</button>
            </div>
        </form>
    </div>
</body>

        <?php
        return ob_get_clean(); // Retourne le contenu capturé
    }
}