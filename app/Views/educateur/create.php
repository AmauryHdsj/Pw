<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'Éducateur</title>
</head>
<body>

<h2>Formulaire de Création d'Éducateur</h2>
<a href="../EducateurController.php">Retour à la liste des éducateurs</a>

<form action="AddEducateurController.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <br>

    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" name="mot_de_passe" required>
    <br>

    <!-- Radio bouton pour est_administrateur -->
<label for="est_administrateur">Administrateur :</label>
<input type="radio" id="est_administrateur_oui" name="est_administrateur" value="1" <?php if ($educateur->getEstAdministrateur()) echo "checked"; ?>>
<label for="est_administrateur_oui">Oui</label>

<input type="radio" id="est_administrateur_non" name="est_administrateur" value="0" <?php if (!$educateur->getEstAdministrateur()) echo "checked"; ?>>
<label for="est_administrateur_non">Non</label>
<br>


    <label for="licencie_id">Licencié:</label>
    <select name="licencie_id" required>
        <?php foreach ($licencies as $licencie): ?>
            <option value="<?= $licencie->getId(); ?>">
                <?= $licencie->getNumeroLicence() . ' - ' . $licencie->getNom() . ' ' . $licencie->getPrenom(); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <input type="submit" name="action" value="Ajouter Éducateur">
</form>

</body>
</html>
