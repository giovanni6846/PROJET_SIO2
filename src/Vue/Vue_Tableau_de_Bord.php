<?php

namespace App\Vue;

use App\Entity\Mission;
use App\Entity\Prix;
use App\Modele\Modele_Mission;
use App\Utilitaire\Vue_Composant;
use Doctrine\Common\Collections\ArrayCollection;

class Vue_Tableau_de_Bord extends Vue_Composant
{
    private string $msgErreur;
    private array $justificatif;
    private ?Mission $mission;

    public function __construct($mission = null,  $justificatif = [], $msgErreur = "")
    {
        $this->msgErreur = $msgErreur;
        $this->mission = $mission;
        $this->justificatif = $justificatif;
    }

    function donneTexte(): string
    {
        ob_start(); // Démarre la capture de sortie
        ?>
        <body>
        <script>
            const missionStatus = <?php echo json_encode($this->mission ? $this->mission->getStatus() : ''); ?>;
            const justificatifs = <?= json_encode($this->justificatif) ?>;
        </script>
        <!-- Header -->
        <header>
            <h1>Détails de la Mission <?= htmlspecialchars($this->mission->getNomMission()) ?></h1>
        </header>

        <!-- Navigation -->
        <nav>
            <a href='index.php?action=tableau_de_bord'>Tableau de Bord</a>
            <a href='index.php?action=ajouter_NDF'>Ajouter une Note de Frais</a>
            <a href='index.php?action=mon_espace'>Mon Espace</a>
            <a href='index.php?action=deconnexion'>Se Déconnecter</a>
        </nav>

        <!-- Buttons -->
        <div class="button-container">
            <form action="index.php" method="post">
                <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                <button type="submit" name="action" value="precedent">Note de frais précédente</button>
            </form>
            <form action="index.php" method="post">
                <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                <button type="submit" name="action" value="suivant">Note de frais suivante</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="container">
            <h2>Informations sur la Mission</h2>
            <div class="mission-details">
                <h3>Détails</h3>
                <p><strong>Nom de la Mission :</strong> <?= htmlspecialchars($this->mission->getNomMission()) ?></p>
                <p><strong>Employé :</strong> <?= htmlspecialchars($this->mission->getEmploye()->getNom()) ?>
                    <?= htmlspecialchars($this->mission->getEmploye()->getPrenom()) ?></p>
                <p><strong>Lieu :</strong> <?= htmlspecialchars($this->mission->getVille()->getNomVille()) ?>
                    <?= htmlspecialchars($this->mission->getVille()->getCpVille()) ?></p>
                <p><strong>Date de Début :</strong> <?= htmlspecialchars($this->mission->getDateDebut()->format('d/m/Y')) ?></p>
                <p><strong>Date de Fin :</strong> <?= htmlspecialchars($this->mission->getDateFin()->format('d/m/Y')) ?></p>
                <p><strong>Nombres de repas :</strong> <?= htmlspecialchars($this->mission->getNbRepas()) ?></p>
                <p><strong>Nombres de nuits :</strong> <?= htmlspecialchars($this->mission->getNbNuit()) ?></p>
                <p><strong>Transports :</strong> <?php if ($this->mission->getHebergement() == Null){
                    echo "";
                    }else{
                        echo(htmlspecialchars($this->mission->getHebergement()->getNomHotel()));
                    }?></p>
                <p><strong>Déplacement :</strong>
                    <?php
                    $content = '';
                    foreach ($this->mission->getDeplacement() as $deplacer) {
                        $content .= htmlspecialchars($deplacer->getTransport()->getLibelleTransport()) . ' ';
                    }
                    echo $content;
                    ?>
                </p>
            </div>

            <!-- Ajouter et Supprimer des Frais -->
            <?php if ($_SESSION['role'] != 2): ?>
                <!-- Afficher les boutons pour les rôles autres que 2 -->
                <div class="ajouter">
                    <form action="index.php" method="post">
                        <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                        <button type="submit" name="action" value="ajouter">Ajouter des frais</button>
                    </form>
                </div>
                <div class="supprimer">
                    <form action="index.php" method="post">
                        <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                        <button type="submit" name="action" value="supprimer">Supprimer des frais</button>
                    </form>
                </div>
                <div class="status">
                    <form action="index.php" method="post">
                        <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                        <button type="submit" name="action" value="status">Confirmer la note de frais</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="boutons-container">
                    <div class="accepter">
                        <form action="index.php" method="post">
                            <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                            <button type="submit" name="action" value="accepter">Accepter</button>
                        </form>
                    </div>
                    <div class="rejeter">
                        <form action="index.php" method="post">
                            <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                            <button type="submit" name="action" value="rejeter">Rejeter</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <div class="button-imp">
                <form action="index.php" method="post">
                    <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                    <button type="submit" name="action" value="pdf">Impression PDF</button>
                </form>
            </div>

            <div id="justificatifsContainer"></div> <!-- Ici vont être ajoutés les selects -->

            <!-- Détails des Frais -->
            <div class="detail_frais">
                <div class="frais-card">
                    <h3>Hébergement</h3>
                    <p><strong>Hôtel :</strong> <?php if ($this->mission->getHebergement() == Null){
                            echo "";
                        }else{
                            echo(htmlspecialchars($this->mission->getHebergement()->getNomHotel()));
                        } ?></p>
                    <p><strong>Coût :</strong> <?= htmlspecialchars($this->mission->getHebergement()->getPrix()->getMontant()) * htmlspecialchars($this->mission->getNbNuit()) ?> €</p>
                </div>

                <div class="frais-card">
                    <h3>Repas</h3>
                    <p><strong>Nombre de Repas :</strong> <?= htmlspecialchars($this->mission->getNbRepas()) ?></p>
                    <p><strong>Coût Total :</strong> <?= (int)(htmlspecialchars($this->mission->getNbRepas()) * htmlspecialchars($this->mission->getPrix()->getMontant())) ?> €</p>
                </div>

                <div class="frais-deplacement">
                    <h3>Transport</h3>
                    <p><strong>Nombre de transports:</strong> <?php
                                                                $nbr = 0;
                                                                foreach ($this->mission->getDeplacement() as $deplacer) {
                                                                    $nbr++;
                                                                };
                                                                echo $nbr;?></p>
                    <p><strong>Coût :</strong> <?php
                         $content = Modele_Mission::cout($this->mission);
                         echo $content;
                        ' ';
                        ?> €</p>
                </div>

                <div class="frais-card">
                    <h3>Statut</h3>
                    <p class="status-text <?= strtolower($this->mission->getStatus()) ?>">
                        <?= htmlspecialchars($this->mission->getStatus()) ?>
                    </p>
                </div>

                <div class="frais-card total">
                    <h3>Total</h3>
                    <p><strong>Coût Total Mission :</strong>
                        <?=  htmlspecialchars($this->mission->getHebergement()->getPrix()->getMontant()) * htmlspecialchars($this->mission->getNbNuit()) + (int)(htmlspecialchars($this->mission->getNbRepas()) * htmlspecialchars($this->mission->getPrix()->getMontant())) + (float)(htmlspecialchars(Modele_Mission::cout($this->mission))) ?> €
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 Gestion des Notes de Frais. Tous droits réservés.</p>
        </footer>

        <!-- Message d'erreur -->
        <?php if ($this->msgErreur !== ""): ?>
            <div class="error-message"><?= htmlspecialchars($this->msgErreur) ?></div>
        <?php endif; ?>
        </body>
        <?php
        return ob_get_clean(); // Retourne le contenu capturé
    }
}
