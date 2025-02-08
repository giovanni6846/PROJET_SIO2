document.addEventListener("DOMContentLoaded", function () {
    // Sélection des éléments
    const inputsVille = document.querySelectorAll('input[name="ville"]'); // Champs texte pour la ville
    const inputsVilleId = document.querySelectorAll('input[name="id"]'); // Champs cachés pour l'ID
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
