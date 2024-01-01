<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Éducateur</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Modifier un Éducateur</h1>
    <a href="../EducateurController.php">Retour à la liste des éducateurs</a>

    <?php if ($educateur): ?>
        <form action="EditEducateurController.php?id=<?php echo $educateur->getId(); ?>" method="post">
            <label for="email">Email :</label>
            <input type="text" id="email" name="email" value="<?php echo $educateur->getEmail(); ?>" required><br>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?php echo $educateur->getMotDePasse(); ?>" required><br>

            <!-- Radio bouton pour est_administrateur -->
            <label for="est_administrateur">Administrateur :
            <input type="radio" id="est_administrateur" name="est_administrateur" value="1" <?php if ($educateur->getEstAdministrateur()) echo "checked"; ?>> Oui
            <input type="radio" id="est_administrateur" name="est_administrateur" value="0" <?php if (!$educateur->getEstAdministrateur()) echo "checked"; ?>> Non
            </label>
            <br>


            <!-- Liste déroulante pour le licencié -->
            <label for="licencie">Licencié :</label>
            <select id="licencie" name="licencie" required>
                <?php foreach ($licencies as $licencie): ?>
                    <option value="<?php echo $licencie->getId(); ?>" <?php if ($licencie->getId() === $educateur->getLicencie()->getId()) echo "selected"; ?>>
                        <?php echo $licencie->getNom() . ' ' . $licencie->getPrenom(); ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <input type="submit" value="Modifier">
        </form>
    <?php else: ?>
        <p>L'éducateur n'a pas été trouvé.</p>
    <?php endif; ?>

</body>
</html>
