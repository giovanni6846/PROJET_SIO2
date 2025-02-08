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
            <a href='index.php?action=ajouter_NDF'>Ajouter une Note de Frais</a>
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
        <?php
    return ob_get_clean(); // Retourne le contenu capturé
    }
}
