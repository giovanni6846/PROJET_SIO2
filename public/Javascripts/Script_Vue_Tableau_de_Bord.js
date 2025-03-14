// Récupérer le statut de la mission depuis PHP
 // Assurez-vous que cette variable est correctement transmise

// Fonction pour griser les boutons si le statut n'est pas "En-Cours"
function disableButtons() {
    if (missionStatus !== "En-Cours") {
        console.log(missionStatus);
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
    select.addEventListener('change', function () {
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