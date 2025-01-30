<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Ajouter_NDF extends Vue_Composant
{
    private string $msgErreur;
    private array $ville;

    public function __construct(string $msgErreur ="",$ville = [])
    {
        $this->msgErreur=$msgErreur;
        $this->ville = $ville;
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
        <a href='index.php?action=tableau_de_bord'>Tableau de Bord</a>
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
        // Récupérer les éléments spécifiques
        const inputVille = document.getElementById('ville');
        const modalVille = document.getElementById('modal-ville');
        const closeModalVille = document.getElementById('close-modal-ville');
        const selectVille = document.getElementById('paged-select');
        const searchBar = document.getElementById('search-bar');

        // Empêcher le focus par défaut sur les champs au chargement de la page
        window.onload = function () {
            document.activeElement.blur();
        };

        // Afficher la modal lors du clic sur le champ "ville"
        inputVille.addEventListener('click', () => {
            modalVille.style.display = 'flex'; // Afficher la modal avec Flexbox
        });

        // Fermer la modal au clic sur "Fermer"
        closeModalVille.addEventListener('click', () => {
            modalVille.style.display = 'none'; // Cacher la modal
        });

        // Optionnel : Fermer la modal au clic en dehors de son contenu
        modalVille.addEventListener('click', (e) => {
            if (e.target === modalVille) {
                modalVille.style.display = 'none';
            }
        });

        // Fonction pour filtrer les villes selon la saisie dans le champ de recherche
        function filterCities() {
            const searchInput = searchBar.value.toLowerCase();
            const options = selectVille.getElementsByTagName('option');

            // Parcours de toutes les options
            for (let i = 0; i < options.length; i++) {
                const option = options[i];
                const cityName = option.textContent.toLowerCase();

                // Si la ville correspond à la recherche, on l'affiche, sinon on la cache
                if (cityName.includes(searchInput)) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            }
        }

        // Lancer le filtrage à chaque saisie dans la barre de recherche
        searchBar.addEventListener('keyup', filterCities);

        // Mettre à jour le champ "ville" lors du double clic sur une option
        selectVille.addEventListener('dblclick', function (event) {
            const selectedOption = event.target;

            // Vérifie si un élément <option> est double-cliqué
            if (selectedOption.tagName === 'OPTION') {
                // Met à jour le champ de texte #ville avec la valeur sélectionnée
                inputVille.value = selectedOption.value;

                const hiddenIdInput = document.querySelector('input[name="id"]'); // Sélectionne le champ caché
                hiddenIdInput.value = selectedOption.id; // Met à jour sa valeur
                // Ferme la modale après sélection
                modalVille.style.display = 'none';
            }
        });
    </script>
</body>

        <?php
        return ob_get_clean(); // Retourne le contenu capturé
    }
}