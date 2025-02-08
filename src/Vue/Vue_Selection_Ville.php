<?php

namespace App\Vue;

use App\Entity\Employe;
use App\Entity\Mission;
use App\Entity\Ville;
use App\Utilitaire\Vue_Composant;

class Vue_Selection_Ville   extends Vue_Composant
{
    private array $ville;

    public function __construct( $ville = [])
    {
        $this->ville = $ville;
    }

    function donneTexte(): string
    {
        ob_start(); // Démarre la capture de sortie
        ?>
        </div>
        <div id="modal-ville" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Choisissez une ville</h3>
                    <input type="text" id="search-bar" placeholder="Recherchez une ville..." onkeyup="filterCities()" />
                </div>
                <select id="paged-select" size="5">
                    <?php
                    foreach ($this->ville as $ville) {
                        ?>
                        <option value="<?= htmlspecialchars($ville->getNomVille()) ?>"
                                id="<?= htmlspecialchars($ville->getId()) ?>" >
                            <?= htmlspecialchars($ville->getNomVille()) ?>, <?= htmlspecialchars($ville->getCpVille()) ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <button id="close-modal-ville">Fermer</button>
            </div>
        </div>
        <?php
        return ob_get_clean(); // Retourne le contenu capturé
    }
}
