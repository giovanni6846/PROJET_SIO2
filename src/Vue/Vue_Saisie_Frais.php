<?php

namespace App\Vue;

use App\Entity\Mission;
use App\Entity\Voiture;
use App\Entity\Transport;
use App\Modele\Modele_Mission;
use App\Utilitaire\Vue_Composant;
class Vue_Saisie_Frais extends Vue_Composant
{
    private string $msgErreur;

    private ?Mission $mission;

    private array $transport;

    public function __construct( $mission = null, array $transport = [], $msgErreur = "")
    {
        $this->msgErreur = $msgErreur;
        $this->mission = $mission;
        $this->transport = $transport;
    }

    function donneTexte(): string
    {
        ob_start(); // Démarre la capture de sortie
        ?>
        <body>
        <div class="container">
        <div class="section hebergement">
            <h1>Saisir Hébergement <?= htmlspecialchars($this->mission->getNomMission()) ?></h1>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <label for="nom_hotel">Nom de l'Hôtel</label>
                <input type="text" id="nom_hotel" name="nom_hotel" required>
                <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                <label for="nom_hotel">Nombres de nuits</label>
                <input type="text" id="nbr_nuit" name="nbr_nuit" required>
                <label for="image">Ajouter un justificatif</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <button type="submit" name="action" value="hebergement">Enregistrer Hébergement</button>
            </form>
        </div>

            <div class="section deplacement">
                <h1>Saisir Déplacement <?= htmlspecialchars($this->mission->getNomMission()) ?></h1>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <label for="transport">Type de Transport</label>
                    <select id="transport" name="transport" onchange="toggleSelects('transport', 'voiture')">
                        <option value= "null" >Transport</option>
                        <?php foreach ($this->transport as $transports): ?>
                            <?php if ($transports->getVoiture() == NULL): ?>
                                <option value="<?= htmlspecialchars($transports->getId()) ?>">
                                    <?= htmlspecialchars($transports->getLibelleTransport()) ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>

                    <label for="voiture">Voiture</label>
                    <select id="voiture" name="voiture" onchange="toggleSelects('voiture', 'transport'); showKilometersField()">
                        <option value= "null">Voiture</option>
                        <?php foreach ($this->transport as $transports): ?>
                            <?php if ($transports->getVoiture() != NULL): ?>
                                <option value="<?= htmlspecialchars($transports->getId()) ?>">
                                    <?= htmlspecialchars($transports->getLibelleTransport()) ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>

                    <div id="kilometersField" style="display: none;">
                        <label for="kilometers">Kilomètres Parcourus</label>
                        <input type="number" id="kilometers" name="kilometers" min="0">
                    </div>

                    <label for="image">Ajouter un justificatif</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                    <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                    <button type="submit" name="action" value="deplacement">Enregistrer Déplacement</button>
                </form>
            </div>
            <div class="section repas">
            <h1>Saisir Repas <?= htmlspecialchars($this->mission->getNomMission()) ?></h1>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <label for="repas">Nombres de repas</label>
                <input type="number" id="repas" name="repas" min="0" required>
                <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                <button type="submit" name="action" value="repas">Enregistrer Repas</button>
            </form>
        </div>
        </div>
        </body>

        <!-- Message d'erreur -->
        <?php if ($this->msgErreur !== ""): ?>
            <div class="error-message"><?= htmlspecialchars($this->msgErreur) ?></div>
        <?php endif; ?>
        </body>
        <?php
        return ob_get_clean(); // Retourne le contenu capturé
    }
}
