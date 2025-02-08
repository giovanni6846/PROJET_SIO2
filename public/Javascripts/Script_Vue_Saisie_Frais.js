function toggleSelects(selectedId, otherId) {
    var selectedElement = document.getElementById(selectedId);
    var otherElement = document.getElementById(otherId);

    if (selectedElement.value) {
        otherElement.disabled = true;
    } else {
        otherElement.disabled = false;
    }
}

function showKilometersField() {
    var voitureSelect = document.getElementById('voiture');
    var kilometersField = document.getElementById('kilometersField');

    if (voitureSelect.value) {
        kilometersField.style.display = 'block';
    } else {
        kilometersField.style.display = 'none';
    }
}
