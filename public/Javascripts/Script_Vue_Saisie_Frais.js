
    document.addEventListener("DOMContentLoaded", function() {
    let transportSelect = document.getElementById("transport");
    let voitureSelect = document.getElementById("voiture");
    let submitButton = document.querySelector("button[type='submit'][name='action'][value='deplacement']");
    let kilometersField = document.getElementById("kilometersField");

    function toggleSelects(selectedId, otherId) {
    let selectedElement = document.getElementById(selectedId);
    let otherElement = document.getElementById(otherId);

    if (selectedElement.value && selectedElement.value !== "null") {
    otherElement.disabled = true;
} else {
    otherElement.disabled = false;
}

    showKilometersField();
    toggleSubmitButton();
}

    function showKilometersField() {
    if (voitureSelect.value && voitureSelect.value !== "null") {
    kilometersField.style.display = "block";
} else {
    kilometersField.style.display = "none";
}
}

    function toggleSubmitButton() {
    let transportValue = transportSelect.value;
    let voitureValue = voitureSelect.value;

    // Si les deux valeurs sont "null" (Transport et Voiture), on désactive le bouton
    if (transportValue === "null" && voitureValue === "null") {
    submitButton.disabled = true;
} else {
    submitButton.disabled = false;
}
}

    // Ajout des écouteurs d'événements
    transportSelect.addEventListener("change", function() {
    toggleSelects("transport", "voiture");
});

    voitureSelect.addEventListener("change", function() {
    toggleSelects("voiture", "transport");
});

    // Vérification initiale au chargement de la page
    toggleSubmitButton();
});
