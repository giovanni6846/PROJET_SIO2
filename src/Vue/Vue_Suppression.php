<?php

namespace App\Vue;

use App\Entity\Mission;
use App\Modele\Modele_Mission;
use App\Utilitaire\Vue_Composant;
class Vue_Suppression extends Vue_Composant
{
    private string $msgErreur;

    private ?Mission $mission;

    public function __construct( $mission = null, $msgErreur = "")
    {
        $this->msgErreur = $msgErreur;
        $this->mission = $mission;
    }

    function donneTexte(): string
    {
        ob_start(); // Démarre la capture de sortie
        ?>
        <body>
        <div class="container">
            <?php if ($this->mission->getHebergement() != NULL){ ?>
            <h1>Suppression hébergement <?= htmlspecialchars($this->mission->getNomMission()) ?></h1>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <label for="nom_hotel">Nom de l'hébergement: <?= htmlspecialchars($this->mission->getHebergement()->getNomHotel()) ?> </label>
                <label for="nom_hotel">Nombres de nuits: <?= htmlspecialchars($this->mission->getNbNuit()) ?></label>
                <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                <button type="submit" name="action" value="delete">Supprimer l'hébergement</button>
            </form>
            <?php }; ?>

            <?php if ($this->mission->getNbRepas() != 0){ ?>
            <h1>Suppression repas <?= htmlspecialchars($this->mission->getNomMission()) ?></h1>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <label for="nom_hotel">Nombres de repas: <?= htmlspecialchars($this->mission->getNbRepas()) ?> </label>
                <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                <button type="submit" name="action" value="delete">Supprimer le(s) repas</button>
            </form>
            <?php }; ?>

            <h1>Suppression déplacement <?= htmlspecialchars($this->mission->getNomMission()) ?></h1>
            <?php foreach ($this->mission->getDeplacement() as $deplacements): ?>
                <?php
                $id = htmlspecialchars($deplacements->getId());
                $transport = htmlspecialchars($deplacements->getTransport()->getLibelleTransport());
                $cout = htmlspecialchars($deplacements->getCout());
                ?>
                <div>
                    <span>
                        Déplacement <?= $id ?>: <?= $transport ?> <?= $cout ?> euros
                    </span>
                    <form method="post" action="index.php" style="display: inline;">
                        <input type="hidden" name="deplacement_id" value="<?= $id ?>">
                        <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                        <input type="hidden" name="msg_delete" value="Déplacement supprimer">
                        <button type="submit" name="action" value="delete">Supprimer</button>
                    </form>
                </div>
                <br>
            <?php endforeach; ?>

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
