<?php

namespace App\Vue;

use App\Entity\Employe;
use App\Entity\Mission;
use App\Entity\Ville;
use App\Utilitaire\Vue_Composant;

class Vue_Utilisateur   extends Vue_Composant
{
    private ?Employe $employe;
    private array $ville;

    public function __construct($employe = null, $ville = [])
    {
        $this->employe = $employe;
        $this->ville = $ville;
    }

    function donneTexte(): string
    {
    ob_start(); // Démarre la capture de sortie
    ?>
        <body>
        <!-- Header -->
        <header>
            <h1>Mon Espace</h1>
        </header>

        <!-- Navigation -->
        <nav>
            <a href='index.php?action=mission'>Tableau de Bord</a>
            <a href='index.php?action="ajouter_NDF'>Ajouter une Note de Frais</a>
            <a href='index.php?action=deconnexion'>Se Déconnecter</a>
        </nav>
        <div class="utilisateur">
            <!-- Section gauche : Détails utilisateur -->
            <div class="details">
                <p><strong>Nom :</strong> <?= htmlspecialchars($this->employe->getNom()) ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($this->employe->getPrenom()) ?></p>
                <p><strong>Ville :</strong> <?= htmlspecialchars($this->employe->getVille()->getNomVille()) ?></p>
                <p><strong>Code Postal :</strong> <?= htmlspecialchars($this->employe->getVille()->getCpVille()) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars(($this->employe->getEmail())) ?></p>
                <p><strong>Numéro de téléphone :</strong> <?= htmlspecialchars(($this->employe->getNumTel())) ?></p>
                <p><strong>Rôle :</strong> <?= htmlspecialchars(($this->employe->getRole())) ?></p>
            </div>

            <!-- Section droite : Formulaire -->
            <div class="form-container">
                <h2>Modification des données</h2>
                <form action='index.php' method='post'>
                    <div class='form-group'>
                        <label for='ville'>Ville</label>
                        <input type='text' id='ville' name='ville' value="<?= htmlspecialchars($this->employe->getVille()->getNomVille()) ?>" readonly>
                    </div>
                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input type='email' id='email' name='email' value="<?= htmlspecialchars($this->employe->getEmail())?>">
                    </div>
                    <div class='form-group'>
                        <label for='num_tel'>Numéro de téléphone</label>
                        <input type='tel' id='num_tel' name='num_tel' value="<?= htmlspecialchars($this->employe->getNumTel())?>">
                    </div>
                    <div class="but-maj">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($this->employe->getVille()->getId()) ?>">
                        <button type="submit" name="action" value="maj_user">Modifier les informations</button>
                    </div>
                </form>
            </div>
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
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Sélection des éléments
                const inputsVille = document.querySelectorAll('input[name="ville[]"]'); // Champs texte pour la ville
                const inputsVilleId = document.querySelectorAll('input[name="ville_id[]"]'); // Champs cachés pour l'ID
                const modalVille = document.getElementById('modal-ville');
                const closeModalVille = document.getElementById('close-modal-ville');
                const selectVille = document.getElementById('paged-select');
                const searchBar = document.getElementById('search-bar');

                // Empêcher le focus sur un champ au chargement de la page
                window.onload = function () {
                    document.activeElement.blur();
                };

                // Associer chaque champ de ville à son champ caché correspondant
                inputsVille.forEach((inputVille, index) => {
                    inputVille.addEventListener('click', () => {
                        // Stocke l'index de l'input actif
                        modalVille.dataset.currentIndex = index;
                        modalVille.style.display = 'flex';
                    });
                });

                // Sélectionner une ville et remplir les champs (double-clic sur une ville)
                selectVille.addEventListener('dblclick', function (event) {
                    const selectedOption = event.target;

                    if (selectedOption.tagName === 'OPTION') {
                        let index = modalVille.dataset.currentIndex;

                        // Mise à jour du champ texte (nom de la ville)
                        inputsVille[index].value = selectedOption.value;
                        // Mise à jour du champ caché (ID de la ville)
                        inputsVilleId[index].value = selectedOption.id;

                        // Fermer la modal après sélection
                        modalVille.style.display = 'none';
                    }
                });

                // Fermer la modal en cliquant sur "Fermer"
                closeModalVille.addEventListener('click', () => {
                    modalVille.style.display = 'none';
                });

                // Fermer la modal si on clique en dehors de son contenu
                modalVille.addEventListener('click', (e) => {
                    if (e.target === modalVille) {
                        modalVille.style.display = 'none';
                    }
                });

                // Fonction pour filtrer les villes selon la saisie dans le champ de recherche
                function filterCities() {
                    const searchInput = searchBar.value.toLowerCase();
                    const options = selectVille.getElementsByTagName('option');

                    for (let i = 0; i < options.length; i++) {
                        const option = options[i];
                        const cityName = option.textContent.toLowerCase();

                        // Afficher ou masquer les options en fonction de la recherche
                        option.style.display = cityName.includes(searchInput) ? '' : 'none';
                    }
                }

                // Lancer le filtrage à chaque saisie dans la barre de recherche
                searchBar.addEventListener('keyup', filterCities);
            });

        </script>
        <?php
    return ob_get_clean(); // Retourne le contenu capturé
    }
}
