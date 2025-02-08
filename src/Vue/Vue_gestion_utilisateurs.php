<?php
namespace App\Vue;
use App\Modele\Modele_Mission;
use App\Utilitaire\Vue_Composant;

class Vue_gestion_utilisateurs extends Vue_Composant
{
    private string $msgErreur;
    private array $utilisateurs;

    public function __construct(string $msgErreur ="", $utilisateurs = [])
    {
        $this->msgErreur=$msgErreur;
        $this->utilisateurs = $utilisateurs;
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
                    <th>Rôle</th>
                    <th></th>
                </tr>
                </thead>
                <!-- Corps du tableau avec les utilisateurs -->
                <tbody>
                <?php foreach ($this->utilisateurs as $utilisateur) { ?>
                    <form action='index.php' method='post'>
                        <tr>
                            <td><input type="text"    name="id_utilisateur"           value="<?= htmlspecialchars($utilisateur->getId()) ?>" readonly></td>
                            <td><input type="text"    name="nom"          value="<?= htmlspecialchars($utilisateur->getNom()) ?>"></td>
                            <td><input type="text"    name="prenom"       value="<?= htmlspecialchars($utilisateur->getPrenom()) ?>"></td>
                            <td><input type="text"    name="ville"        value="<?= isset($utilisateur) && $utilisateur->getVille() ? htmlspecialchars($utilisateur->getVille()->getNomVille()) : '' ?>" readonly></td>
                                <input type="hidden"  name="id"           value="<?= isset($utilisateur) && $utilisateur->getVille() ? htmlspecialchars($utilisateur->getVille()->getId()) : '' ?>">
                            <td><input type="text"    name="mot_de_passe" value="<?= htmlspecialchars($utilisateur->getMdp() ?? '') ?>"></td>
                            <td><input type="email"   name="email"        value="<?= htmlspecialchars($utilisateur->getEmail()?? '') ?>"></td>
                            <td><input type="tel"     name="num_tel"      value="<?= htmlspecialchars($utilisateur->getNumTel()?? '') ?>"></td>
                            <td><input type="number"  name="role"         value="<?= htmlspecialchars($utilisateur->getRole()) ?>" min="1" max="3"></td>
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
                    <th>Rôle</th>
                    <th></th>
                </tr>
                </thead>
                <!-- Corps du tableau avec les utilisateurs -->
                <tbody>
                    <form action='index.php' method='post'>
                        <tr>
                            <td><input type="text"    name="nom"          value=""></td>
                            <td><input type="text"    name="prenom"       value=""></td>
                            <td><input type="text"    name="mot_de_passe" value=""></td>
                            <td><input type="number"  name="role"         value="" min="1" max="3"></td>
                            <td><button type="submit" name="action"       value="create_user">Créer</button></td>
                        </tr>
                    </form>
                </tbody>
            </table>
        <?php if ($this->msgErreur !== ""): ?>
            <div class="error-message"><?= htmlspecialchars($this->msgErreur) ?></div>
        <?php endif; ?>
        </body>
        <?php
        return ob_get_clean(); // Retourne le contenu capturé
    }
}