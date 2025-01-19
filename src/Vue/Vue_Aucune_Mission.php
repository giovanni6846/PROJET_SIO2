<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Aucune_Mission extends Vue_Composant
{
    private string $msgErreur;

    public function __construct($msgErreur = "")
    {
        $this->msgErreur = $msgErreur;
    }

    function donneTexte(): string
    {
        ob_start(); // Démarre la capture de sortie
        ?>

        <body>
        <!-- Header -->
        <header>
            <h1>Détails de la Mission : Aucune mission</h1>
        </header>

        <!-- Navigation -->
        <nav>
            <a href='index.php?action=tableau_de_bord'>Tableau de Bord</a>
            <a href='index.php?action=ajouter_note_frais'>Ajouter une Note de Frais</a>
            <a href='index.php?action=consulter_notes'>Consulter les Notes de Frais</a>
            <a href='index.php?action=deconnexion'>Se Déconnecter</a>
        </nav>

        <!-- Message d'erreur -->
        <div class="message-aucune-mission">
            Aucune mission disponible
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 Gestion des Notes de Frais. Tous droits réservés.</p>
        </footer>
        </body>
        </html>
        <?php
        return ob_get_clean(); // Retourne le contenu capturé
    }
}
