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

function hiddenMenu() {
    // Vérifier le rôle de l'utilisateur
    if (typeRole !== 3) {
        console.log(missionStatus);
        // Désactiver les liens spécifiques en fonction de leurs classes
        document.querySelectorAll('nav a.TDB, nav a.NDF, nav a.ME').forEach(a => {
            a.style.display = 'none';  // Cacher ces liens
        });
    }
}

// Appeler la fonction après que la page soit complètement chargée
window.onload = hiddenMenu;
window.onload = disableButtons;


// Fonction pour afficher l'image en grand
function openImage(element) {
    const modal = document.querySelector('.modal');
    const modalImage = document.querySelector('.modal-content');

    modalImage.src = element.querySelector('img').src;
    modal.classList.add('show');
}

// Fonction pour fermer l'image en cliquant en dehors
function closeImage() {
    document.querySelector('.modal').classList.remove('show');
}
