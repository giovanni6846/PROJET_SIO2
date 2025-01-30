<?php

namespace App\Vue;

use App\Entity\Mission;
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
                <button type="submit" name="action" value="suivant">Note de frais suivante</button>
            </form>
            <form action="index.php" method="post">
                <input type="hidden" name="mission" value="<?= htmlspecialchars($this->mission->getId()) ?>">
                <button type="submit" name="action" value="precedent">Note de frais précédente</button>
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
                <p><strong>Hébergement :</strong> <?php if ($this->mission->getHebergement() == Null){
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
                    <p><strong>Coût :</strong> <?= htmlspecialchars($this->mission->getNbNuit()) * 75 ?> €</p>
                </div>

                <div class="frais-card">
                    <h3>Repas</h3>
                    <p><strong>Nombre de Repas :</strong> <?= htmlspecialchars($this->mission->getNbRepas()) ?></p>
                    <p><strong>Coût Total :</strong> <?= (int)(htmlspecialchars($this->mission->getNbRepas()) * 20) ?> €</p>
                </div>

                <div class="frais-deplacement">
                    <h3>Déplacement</h3>
                    <p><strong>Nombre de Déplacement:</strong> <?php
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
                    <h3>Status</h3>
                    <p class="status-text <?= strtolower($this->mission->getStatus()) ?>">
                        <?= htmlspecialchars($this->mission->getStatus()) ?>
                    </p>
                </div>

                <div class="frais-card total">
                    <h3>Total</h3>
                    <p><strong>Coût Total Mission :</strong>
                        <?=  htmlspecialchars($this->mission->getNbNuit()) * 75 + (int)(htmlspecialchars($this->mission->getNbRepas()) * 20) + (float)(htmlspecialchars(Modele_Mission::cout($this->mission))) ?> €
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 Gestion des Notes de Frais. Tous droits réservés.</p>
        </footer>

        <script>
            // Récupérer le statut de la mission depuis PHP
            const missionStatus = "<?= htmlspecialchars($this->mission->getStatus()) ?>"; // Assurez-vous que cette variable est correctement transmise

            // Fonction pour griser les boutons si le statut n'est pas "En-Cours"
            function disableButtons() {
                if (missionStatus !== "En-Cours") {
                    // Désactiver les boutons
                    document.querySelectorAll('.ajouter button, .supprimer button, .status button').forEach(button => {
                        button.disabled = true;
                        button.classList.add('disabled'); // Appliquer la classe pour le style
                    });
                }
            }

            // Appeler la fonction après que la page soit complètement chargée
            window.onload = disableButtons;
            // Justificatifs reçus depuis PHP sous forme d'un tableau
            const justificatifs = <?= json_encode($this->justificatif) ?>;

            const container = document.getElementById('justificatifsContainer');

            justificatifs.forEach((justificatif, index) => {
                // Créer un label et un select pour chaque justificatif
                const label = document.createElement('label');
                label.textContent = `Justificatif ${index + 1} : `;
                const select = document.createElement('select');
                select.setAttribute('data-index', index); // Indiquer l'index de l'élément

                // Ajouter une option par défaut pour chaque select
                const defaultOption = document.createElement('option');
                defaultOption.value = "";
                defaultOption.textContent = "-- Choisissez un justificatif --";
                select.appendChild(defaultOption);

                // Ajouter l'option avec le nom du justificatif
                const option = document.createElement('option');
                option.value = justificatif.chemin;
                option.textContent = justificatif.nom;
                select.appendChild(option);

                // Créer une div pour afficher l'image associée
                const imageContainer = document.createElement('div');
                imageContainer.setAttribute('id', 'image-' + index);
                const imageElement = document.createElement('img');
                imageElement.setAttribute('id', 'image-' + index + '-img');
                imageElement.style.display = 'none';

                // Forcer la taille de l'image
                imageElement.style.width = '750px';  // Exemple de largeur forcée
                imageElement.style.height = '500px'; // Exemple de hauteur forcée
                imageContainer.appendChild(imageElement);

                // Ajouter le label, select et l'image à la page
                container.appendChild(label);
                container.appendChild(select);
                container.appendChild(imageContainer);

                // Ajouter l'événement change sur le select pour changer l'image
                select.addEventListener('change', function() {
                    const selectedValue = select.value;
                    const imageElement = document.getElementById('image-' + index + '-img');
                    if (selectedValue) {
                        imageElement.src = selectedValue; // Changer la source de l'image
                        imageElement.style.display = 'block'; // Afficher l'image
                    } else {
                        imageElement.style.display = 'none'; // Cacher l'image si aucune sélection
                    }
                });
            });
        </script>

        <!-- Message d'erreur -->
        <?php if ($this->msgErreur !== ""): ?>
            <div class="error-message"><?= htmlspecialchars($this->msgErreur) ?></div>
        <?php endif; ?>
        </body>
        <?php
        return ob_get_clean(); // Retourne le contenu capturé
    }
}
