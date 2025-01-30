<?php

use App\Modele\Modele_Mission;

$mission = $_POST["mission"];
$mission = App\Modele\Modele_Mission::mission_search($mission);

// Exemple de création d'un PDF avec TCPDF
ob_start();

// Créer une nouvelle instance de TCPDF
$pdf = new TCPDF();

// Ajouter une page
$pdf->AddPage();

// Définir la police
$pdf->SetFont('helvetica', '', 12);

// Contenu HTML avec un tableau et du texte stylisé
$html = '
<h1>Note de frais ' . htmlspecialchars($mission->getNomMission()) . '</h1>
<br><br>
<h2>Information Employé</h2>
<table cellspacing="0" border="1" style="border-collapse:collapse;">
    <tr>
        <td style="border:2px solid #000;">
            <p><strong>Employé :</strong> ' . htmlspecialchars($mission->getEmploye()->getNom()) . ' ' . htmlspecialchars($mission->getEmploye()->getPrenom()) . '</p>
            <p><strong>Email :</strong> ' . htmlspecialchars($mission->getEmploye()->getEmail()) . '</p>
            <p><strong>Adresse :</strong> ' . htmlspecialchars($mission->getEmploye()->getVille()->getNomVille()) . ' ' . htmlspecialchars($mission->getEmploye()->getVille()->getCpVille()) . '</p>
            <br>
        </td>
    </tr>
</table>
<br>
<h2>Information Mission</h2>
<br>
<table cellspacing="0" border="1" style="border-collapse:collapse;">
    <tr>
        <td style="border:2px solid #000;">
            <p><strong>Nom Mission :</strong> ' . htmlspecialchars($mission->getNomMission()) . '</p>
            <p><strong>Ville :</strong> ' . htmlspecialchars($mission->getVille()->getNomVille()) . ' ' . htmlspecialchars($mission->getVille()->getCpVille()) . ' </p>
            <p><strong>Date début :</strong> ' . htmlspecialchars($mission->getDateDebut()->format('Y-m-d')) . '</p>
            <p><strong>Date fin :</strong> ' . htmlspecialchars($mission->getDateFin()->format('Y-m-d')) . '</p>
            <p><strong>Status :</strong> ' . htmlspecialchars($mission->getStatus()) . '</p>
            <br>
        </td>
    </tr>
</table>
<br><br>
<table border="1" cellpadding="4" cellspacing="0">
    <tr>
        <th><b>Types de frais</b></th>
        <th><b>Nom du frais</b></th>
        <th><b>Montant frais</b></th>
    </tr>';
if ($mission->getHebergement() != null){
    $html .= '<tr>
        <td> Hebergement </td>
        <td> ' . htmlspecialchars($mission->getHebergement()->getNomHotel()) . '</td>
        <td>' . htmlspecialchars($mission->getNbNuit()) . ' x 75 = ' . htmlspecialchars($mission->getNbNuit()) * 75 .'€</td>
    </tr>';
}
if ($mission->getNbRepas() != 0){
    $html .= '<tr>
        <td> Repas </td>
        <td> / </td>
        <td>' . htmlspecialchars($mission->getNbRepas()) . ' x 20 = ' . htmlspecialchars($mission->getNbRepas()) * 20 .'€</td>
    </tr>';
}
foreach ($mission->getDeplacement() as $deplacer) {
    $content = \App\Modele\Modele_Transport::cout_transport($deplacer);
    $html .= '<tr>
        <td> Transport </td>
        <td> ' . htmlspecialchars($deplacer->getTransport()->getLibelleTransport()) . ' </td>
        <td>' . htmlspecialchars($content) .'€</td>
    </tr>';
}

$html .= '</table><br><p> <b>Montant total</b> : ' .  htmlspecialchars($mission->getNbNuit()) * 75 + (int)(htmlspecialchars($mission->getNbRepas()) * 20) + (float)(htmlspecialchars(Modele_Mission::cout($mission))).' €</p>';

// Écrire le HTML dans le PDF
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('Note_de_Frais.pdf', 'D');

die();