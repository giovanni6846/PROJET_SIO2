<?php
namespace App\Vue;
use App\Modele\Modele_Mission;
use App\Utilitaire\Vue_Composant;

class Vue_gestion_utilisateurs extends Vue_Composant
{
    private string $msgErreur;
    private array $utilisateurs;

    private array $ville;
    public function __construct(string $msgErreur ="", $utilisateurs = [], $ville = [])
    {
        $this->msgErreur=$msgErreur;
        $this->utilisateurs = $utilisateurs;
        $this->ville = $ville;
    }

    function donneTexte(): string
    {
        ob_start(); // Démarre la capture de sortie
        ?>
        <body>
        <!-- Header -->
        <header>
            <h1>Gestion utilisateurs</h1>
        </header>

        <!-- Navigation -->
        <nav>
            <a href='index.php?action=mon_espace'>Mon Espace</a>
            <a href='index.php?action=deconnexion'>Se Déconnecter</a>
        </nav>

        <div class="utilisateur">
            <h2>Informations des utilisateurs</h2>
            <table border="1">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Ville</th>
                    <th>Mot de passe</th>
                    <th>Email</th>
                    <th>Numéro de téléphone</th>
                    <th>Action</th>
                </tr>
                </thead>
                <!-- Corps du tableau avec les utilisateurs -->
                <tbody>
                <?php foreach ($this->utilisateurs as $utilisateur) { ?>
                    <form action='index.php' method='post'>
                        <tr>
                            <td><input type="text"    name="id"           value="<?= htmlspecialchars($utilisateur->getId()) ?>" readonly></td>
                            <td><input type="text"    name="nom"          value="<?= htmlspecialchars($utilisateur->getNom()) ?>"></td>
                            <td><input type="text"    name="prenom"       value="<?= htmlspecialchars($utilisateur->getPrenom()) ?>"></td>
                            <td><input type="text"    name="ville"        value="<?= isset($utilisateur) && $utilisateur->getVille() ? htmlspecialchars($utilisateur->getVille()->getNomVille()) : '' ?>" readonly></td>
                                <input type="hidden"  name="ville_id"     value="<?= isset($utilisateur) && $utilisateur->getVille() ? htmlspecialchars($utilisateur->getVille()->getId()) : '' ?>">
                            <td><input type="text"    name="mot_de_passe" value="<?= htmlspecialchars($utilisateur->getMdp() ?? '') ?>"></td>
                            <td><input type="email"   name="email"        value="<?= htmlspecialchars($utilisateur->getEmail()?? '') ?>"></td>
                            <td><input type="tel"     name="num_tel"      value="<?= htmlspecialchars($utilisateur->getNumTel()?? '') ?>"></td>
                            <td><input type="number"  name="role"         value="<?= htmlspecialchars($utilisateur->getRole()) ?>"></td>
                            <td><button type="submit" name="action"       value="maj_user">Modifier</button></td>
                        </tr>
                    </form>
                <?php } ?>
                </tbody>
            </table>
            <h2>Création d'utilisateur</h2>
            <table border="1">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Mot de passe</th>
                    <th>Action</th>
                </tr>
                </thead>
                <!-- Corps du tableau avec les utilisateurs -->
                <tbody>
                    <form action='index.php' method='post'>
                        <tr>
                            <td><input type="text"    name="nom"          value=""></td>
                            <td><input type="text"    name="prenom"       value=""></td>
                            <td><input type="text"    name="mot_de_passe" value=""></td>
                            <td><input type="number"  name="role"         value=""></td>
                            <td><button type="submit" name="action"       value="create_user">Créer</button></td>
                        </tr>
                    </form>
                </tbody>
            </table>
            <div id="modal-ville" class="modal" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Choisissez une ville</h3>
                        <input type="text" id="search-bar" placeholder="Recherchez une ville..." onkeyup="filterCities()" />
                    </div>
                    <select id="paged-select" size="5">
                        <?php foreach ($this->ville as $ville) { ?>
                            <option value="<?= htmlspecialchars($ville->getNomVille()) ?>"
                                    id="<?= htmlspecialchars($ville->getId()) ?>">
                                <?= htmlspecialchars($ville->getNomVille()) ?>, <?= htmlspecialchars($ville->getCpVille()) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button id="close-modal-ville">Fermer</button>
                </div>
            </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Sélection des éléments
                const inputsVille = document.querySelectorAll('input[name="ville"]'); // Tous les champs de ville
                const inputsVilleId = document.querySelectorAll('input[name="ville_id"]'); // Tous les champs ID cachés
                const modalVille = document.getElementById('modal-ville');
                const selectVille = document.getElementById('paged-select');
                const closeModalVille = document.getElementById('close-modal-ville');
                const searchBar = document.getElementById('search-bar');

                // Empêcher le focus sur un champ au chargement de la page
                window.onload = function () {
                    document.activeElement.blur();
                };

                // Associer chaque champ de ville à son ID caché
                inputsVille.forEach((inputVille, index) => {
                    inputVille.addEventListener('click', () => {
                        // Stocke l'input actif
                        modalVille.dataset.currentIndex = index;
                        modalVille.style.display = 'flex';
                    });
                });

                // Sélectionner une ville et remplir les champs
                selectVille.addEventListener('dblclick', function (event) {
                    const selectedOption = event.target;

                    if (selectedOption.tagName === 'OPTION') {
                        let index = modalVille.dataset.currentIndex;

                        // Mise à jour du champ texte (nom de la ville)
                        inputsVille[index].value = selectedOption.value;
                        // Mise à jour du champ caché (ID de la ville)
                        inputsVilleId[index].value = selectedOption.id;

                        // Fermer la modal
                        modalVille.style.display = 'none';
                    }
                });

                // Fermer la modal si on clique en dehors
                modalVille.addEventListener('click', (e) => {
                    if (e.target === modalVille) {
                        modalVille.style.display = 'none';
                    }
                });

                // Fermer la modal en cliquant sur "Fermer"
                closeModalVille.addEventListener('click', () => {
                    modalVille.style.display = 'none';
                });

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
        <?php if ($this->msgErreur !== ""): ?>
            <div class="error-message"><?= htmlspecialchars($this->msgErreur) ?></div>
        <?php endif; ?>
        </body>
        <?php
        return ob_get_clean(); // Retourne le contenu capturé
    }
}