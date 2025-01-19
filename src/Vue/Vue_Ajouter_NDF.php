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
        $str= "
                <body>
    <div class='form-container'>
        <h2>Ajouter une Note de Frais</h2>
        <form action='index.php' method='post'>
            <div class='form-group'>
                <label for='destination'>Destination</label>
                <input type='text' id='destination' name='destination' required>
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
                <button type='submit' name ='action' value='ajouter_NDF'>Ajouter</button>
            </div>
        </form>
    </div>
</body>

    " ;
        if($this->msgErreur != "")
        {
            $str .=  " <label><b>Erreur : $this->msgErreur</b></label>";
        }
        return $str ;
    }
}